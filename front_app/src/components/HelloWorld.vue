<template>
  <div class="hello">
    <h1>{{ msg }}</h1>
    <el-row type="flex" class="row-bg" justify="space-around">
      <el-col :span="10">
        <div class="grid-content bg-purple-light">
          <div>
            <el-tabs type="border-card" v-model="activeName">
              <!-- - -->
              <el-tab-pane label="Login / Register" name="first">
                <div v-if="!logged">
                  <div style="float: left;padding-bottom: 1em;">
                    <el-button type="primary" @click="login = true, register = false">Login</el-button>
                    <el-button type="primary" @click="register = true, login = false">Register</el-button>
                  </div>
                  <div>
                    <el-input placeholder="Email" type="email" v-model="form.email"></el-input>
                    <el-input placeholder="Name" v-model="form.name" v-if="register && !login"></el-input>
                    <el-input placeholder="Password" v-model="form.password"/>
                    <el-button type="primary" @click="handleAuth">Submit</el-button>
                  </div>
                </div>
                <div v-else>You are logged in</div>
              </el-tab-pane>
              <!-- - -->
              <el-tab-pane label="Users" name="second">
                <div v-if="logged">
                  <div style="float: left;padding-bottom: 1em;">
                    <el-button type="primary" @click="showUserDialog">Create</el-button>
                  </div>
                  <el-table :data="users" border style="width: 100%">
                    <el-table-column prop="name" label="Name" width="180"></el-table-column>
                    <el-table-column prop="email" label="Email" width="180"></el-table-column>
                    <el-table-column label="Actions">
                      <template slot-scope="scope">
                        <el-button type="primary" @click="getUserGroups(scope.row)">Groups</el-button>
                        <el-button type="warning" @click="editUser(scope.row)">Edit</el-button>
                        <el-button type="danger" @click="deleteUser(scope.row)">Delete</el-button>
                      </template>
                    </el-table-column>
                  </el-table>
                  <div style="float: left;padding-top: 1em;">
                    <el-button type="primary" @click="getUsers">Load data</el-button>
                  </div>
                </div>
                <div v-else>You are not logged in</div>
              </el-tab-pane>
              <!-- - -->
              <el-tab-pane label="Groups" name="third">
                <div v-if="logged">
                  <div style="float: left;padding-bottom: 1em;">
                    <el-button type="primary" @click="createGroup">Create</el-button>
                  </div>
                  <el-table :data="groups" border style="width: 100%">
                    <el-table-column prop="name" label="Name" width="180"></el-table-column>
                    <el-table-column label="Actions">
                      <template slot-scope="scope">
                        <el-button type="primary" @click="getPermissions(scope.row)">Permissions</el-button>
                        <el-button type="warning" @click="editGroup(scope.row)">Edit</el-button>
                        <el-button type="danger" @click="deleteGroup(scope.row)">Delete</el-button>
                      </template>
                    </el-table-column>
                  </el-table>
                  <div style="float: left;padding-top: 1em;">
                    <el-button type="primary" @click="getGroups">Load data</el-button>
                  </div>
                </div>
                <div v-else>You are not logged in</div>
              </el-tab-pane>
              <!-- - -->
            </el-tabs>
          </div>
        </div>
      </el-col>
    </el-row>
    <!-- - -->
    <el-dialog title="Group Permissions" :visible.sync="permissionsDialog" width="30%">
      <div>
        <el-tag
          :key="index"
          v-for="(permission,index) in permissions"
          closable
          :disable-transitions="false"
          @close="deletePermission(permission)"
          style="margin-right: 1em;margin-bottom: 1em"
        >{{permission.name}}</el-tag>
        <el-input
          class="input-new-tag"
          v-if="inputVisible"
          v-model="inputValue"
          ref="savePermissionInput"
          placeholder="Name should be min 4 characters , press enter when ready"
          size="mini"
          minlength="4"
          @keyup.enter.native="setPermission"
          @blur="setPermission"
        ></el-input>
        <el-button v-else class="button-new-tag" size="small" @click="showInput">+ New Permission</el-button>
      </div>
      <span slot="footer" class="dialog-footer">
        <el-button @click="permissionsDialog = false">Close</el-button>
      </span>
    </el-dialog>
    <!-- - -->
    <el-dialog title="User groups" :visible.sync="groupsDialog" width="30%">
      <div>
        <el-tag
          :key="index"
          v-for="(group,index) in userGroups"
          closable
          :disable-transitions="false"
          @close="deleteUserGroup(group)"
          style="margin-right: 1em;margin-bottom: 1em"
        >{{group.name}}</el-tag>
        <div>
          <el-autocomplete
            v-model="queryGroups"
            :fetch-suggestions="querySearchAsync"
            placeholder="Search groups"
            @select="handleSelect"
          >
            <template slot-scope="{ item }">
              <div class="value">{{ item.name }}</div>
            </template>
          </el-autocomplete>
        </div>
      </div>
      <span slot="footer" class="dialog-footer">
        <el-button @click="groupsDialog = false">Close</el-button>
      </span>
    </el-dialog>
    <!-- - -->
    <el-dialog title="User" :visible.sync="userDialog" width="30%" :before-close="closeUserDialog">
      <div>
        <el-input placeholder="Email" type="email" v-model="form.email"></el-input>
        <el-input placeholder="Name" v-model="form.name"></el-input>
        <el-input placeholder="Password" v-model="form.password" v-if="!userEdited"/>
        <el-button type="primary" @click="submitUser">Submit</el-button>
      </div>
      <span slot="footer" class="dialog-footer">
        <el-button @click="userDialog = false">Close</el-button>
      </span>
    </el-dialog>
  </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  name: "HelloWorld",
  data() {
    return {
      activeName: "first",
      queryGroups: "",
      links: [],
      timeout: null,
      permissionsDialog: false,
      groupsDialog: false,
      userDialog: false,
      register: false,
      login: true,
      usersPage: 1,
      userGroupsPage: 1,
      groupsPage: 1,
      groupPermissionsPage: 1,
      inputVisible: false,
      inputValue: "",
      userEdited: false,
      row: {},
      form: {
        email: "",
        name: "",
        password: ""
      }
    };
  },
  computed: {
    ...mapGetters({
      token: "token",
      users: "users",
      groups: "groups",
      permissions: "permissions",
      user: "user",
      userGroups: "userGroups",
      error: "error"
    }),
    logged() {
      return typeof this.user !== "undefined" && this.token ? true : false;
    }
  },
  watch: {
    error(val) {
      this.$notify.error({
        title: "Error",
        message: val
      });
    }
  },
  props: {
    msg: String
  },
  async mounted() {
    await this.$store.dispatch("fetchUser", {});
  },
  methods: {
    async handleAuth() {
      if (this.login && !this.register) {
        await this.$store.dispatch("login", this.form);
      } else if (!this.login && this.register) {
        this.form.password_confirmation = this.form.password;
        await this.$store.dispatch("register", this.form);
      }
    },
    async getUsers() {
      await this.$store
        .dispatch("getUsers", { page: this.usersPage })
        .then(() => {
          this.usersPage++;
        });
    },
    async getUserGroups(row) {
      this.groupsDialog = true;
      this.userGroupsPage = 1;
      this.row = row;

      await this.$store
        .dispatch("getUserGroups", { user: row, page: this.userGroupsPage })
        .then(() => {
          this.userGroupsPage++;
        });
    },
    async getGroups() {
      await this.$store
        .dispatch("getGroups", { page: this.groupsPage })
        .then(() => {
          this.groupsPage++;
        });
    },
    async getPermissions(row) {
      this.permissionsDialog = true;
      this.groupPermissionsPage = 1;

      await this.$store
        .dispatch("getGroupPermissions", {
          group: row,
          page: this.groupPermissionsPage
        })
        .then(() => {
          this.groupPermissionsPage++;
        });
    },
    showInput() {
      this.inputVisible = true;
      this.$nextTick(_ => {
        this.$refs.savePermissionInput.$refs.input.focus();
      });
    },
    async deletePermission(row) {
      await this.$store.dispatch("deleteGroupPermission", { permission: row });
    },
    async setPermission(row) {
      let inputValue = this.inputValue;
      //
      if (inputValue && inputValue.length >= 4) {
        let currentPermissions = this.permissions.map(a => a.name);
        currentPermissions.push(inputValue);
        await this.$store.dispatch("addGroupPermission", {
          name: currentPermissions
        });
        this.inputVisible = false;
        this.inputValue = "";
      }
    },
    showUserDialog() {
      if (this.userDialog) {
        this.userDialog = false;
      } else {
        this.userDialog = true;
      }
    },
    emptyForm() {
      this.userEdited = false;
      this.form.name = "";
      this.form.email = "";
      this.form.password = "";
      this.form.password_confirmation = "";
    },
    submitUser() {
      if (this.userEdited) {
        this.$store
          .dispatch("editUser", { user: this.row, form: this.form })
          .then(() => {
            this.emptyForm();
          });
        this.showUserDialog();
      } else {
        this.form.password_confirmation = this.form.password;
        this.$store.dispatch("createUser", this.form).then(() => {
          this.emptyForm();
        });
        this.showUserDialog();
      }
    },
    createGroup() {
      this.$prompt("New group name", "Create group", {
        confirmButtonText: "OK",
        cancelButtonText: "Cancel",
        inputPlaceholder: "Name",
        inputPattern: /^.{4,}$/,
        inputErrorMessage: "Invalid name , min length 4"
      })
        .then(({ value }) => {
          this.$store.dispatch("createGroup", { name: value });
        })
        .catch(() => {});
    },
    async editGroup(row) {
      this.$prompt("New group name", "Edit group name", {
        confirmButtonText: "OK",
        cancelButtonText: "Cancel",
        inputPlaceholder: "Name",
        inputPattern: /^.{4,}$/,
        inputErrorMessage: "Invalid name , min length 4"
      })
        .then(({ value }) => {
          this.$store.dispatch("editGroup", { group: row, name: value });
        })
        .catch(() => {});
    },
    async deleteGroup(row) {
      this.$confirm(
        "This will permanently delete the group. Continue?",
        "Delete Group",
        {
          confirmButtonText: "OK",
          cancelButtonText: "Cancel",
          type: "warning"
        }
      )
        .then(() => {
          this.$store.dispatch("deleteGroup", { group: row });
        })
        .catch(() => {});
    },
    async deleteUser(row) {
      this.$confirm(
        "This will permanently delete the user. Continue?",
        "Delete User",
        {
          confirmButtonText: "OK",
          cancelButtonText: "Cancel",
          type: "warning"
        }
      )
        .then(() => {
          this.$store.dispatch("deleteUser", { user: row });
        })
        .catch(() => {});
    },
    closeUserDialog() {
      this.userDialog = false;
      this.userEdited = false;
    },
    async editUser(row) {
      this.showUserDialog();
      this.userEdited = true;
      this.form.name = row.name;
      this.form.email = row.email;
      this.row = row;
    },
    async deleteUserGroup(group) {
      await this.$store.dispatch("deleteUserGroup", { group, user: this.row });
    },
    async querySearchAsync(queryString, cb) {
      let results = await this.$store
        .dispatch("searchGroups", { query: queryString })
        .then(data => {
          return data;
        });
      cb(results);
    },
    async handleSelect(item) {
      await this.$store.dispatch("addUserGroup", {
        user: this.row,
        group: item
      });
    }
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="scss">
h3 {
  margin: 40px 0 0;
}

.grid-content {
  border-radius: 4px;
  min-height: 36px;
}

.el-input {
  padding-bottom: 1em;
}
</style>
