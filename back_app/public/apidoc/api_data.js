define({ "api": [
  {
    "type": "get",
    "url": "/user",
    "title": "Request current user",
    "name": "GetCurrentUser",
    "group": "Auth",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "user",
            "description": "<p>User object.</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "validation_failed",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "missing_role",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "missing_role_permissions",
            "description": ""
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "routes/api.php",
    "groupTitle": "Auth"
  },
  {
    "type": "post",
    "url": "/login",
    "title": "Login user",
    "name": "LoginUser",
    "group": "Auth",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "size": "4",
            "optional": false,
            "field": "email",
            "description": "<p>User email</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "size": "6",
            "optional": false,
            "field": "password",
            "description": "<p>User password</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "user",
            "description": "<p>User object.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>User token.</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "not_found",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "validation_failed",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "missing_role",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "missing_role_permissions",
            "description": ""
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "routes/api.php",
    "groupTitle": "Auth"
  },
  {
    "type": "post",
    "url": "/register",
    "title": "Register user",
    "name": "RegisterUser",
    "group": "Auth",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "size": "4",
            "optional": false,
            "field": "name",
            "description": "<p>User name</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "size": "4",
            "optional": false,
            "field": "email",
            "description": "<p>User email</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "size": "6",
            "optional": false,
            "field": "password",
            "description": "<p>User password</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "size": "6",
            "optional": false,
            "field": "password_confirmation",
            "description": "<p>User password</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "user",
            "description": "<p>User object.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>User token.</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "not_found",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "validation_failed",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "missing_role",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "missing_role_permissions",
            "description": ""
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "routes/api.php",
    "groupTitle": "Auth"
  },
  {
    "type": "post",
    "url": "/groups",
    "title": "Create group",
    "name": "CreateGroup",
    "group": "Group",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "size": "4",
            "optional": false,
            "field": "name",
            "description": "<p>Group name</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "group",
            "description": "<p>object</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "validation_failed",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "missing_role",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "missing_role_permissions",
            "description": ""
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "routes/api.php",
    "groupTitle": "Group"
  },
  {
    "type": "delete",
    "url": "/groups/:id",
    "title": "Delete group",
    "name": "DeleteGroup",
    "group": "Group",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Group unique ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "204": [
          {
            "group": "204",
            "optional": false,
            "field": "Success",
            "description": ""
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "not_found",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "validation_failed",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "missing_role",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "missing_role_permissions",
            "description": ""
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "routes/api.php",
    "groupTitle": "Group"
  },
  {
    "type": "get",
    "url": "/groups",
    "title": "Request groups list",
    "name": "GetGroups",
    "group": "Group",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "size": "1",
            "optional": false,
            "field": "page",
            "description": "<p>Page number</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "size": "15",
            "optional": false,
            "field": "limit",
            "description": "<p>List limit</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object[]",
            "optional": false,
            "field": "group",
            "description": "<p>List of groups.</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "validation_failed",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "missing_role",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "missing_role_permissions",
            "description": ""
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "routes/api.php",
    "groupTitle": "Group"
  },
  {
    "type": "post",
    "url": "/groups/:group/permissions",
    "title": "Create or update group permissions",
    "name": "CreateUpdateGroupPermission",
    "group": "GroupPermission",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "group",
            "description": "<p>Group unique ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Array",
            "size": "1",
            "optional": false,
            "field": "name",
            "description": "<p>Group permissions names</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object[]",
            "optional": false,
            "field": "permission",
            "description": "<p>List of group permissions.</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "not_found",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "validation_failed",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "missing_role",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "missing_role_permissions",
            "description": ""
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "routes/api.php",
    "groupTitle": "GroupPermission"
  },
  {
    "type": "delete",
    "url": "/groups/:group/permissions/:permission",
    "title": "Delete group permission",
    "name": "DeleteGroupPermission",
    "group": "GroupPermission",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "group",
            "description": "<p>Group unique ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "permission",
            "description": "<p>Permission unique ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "204": [
          {
            "group": "204",
            "optional": false,
            "field": "Success",
            "description": ""
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "not_found",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "missing_role",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "missing_role_permissions",
            "description": ""
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "routes/api.php",
    "groupTitle": "GroupPermission"
  },
  {
    "type": "get",
    "url": "/groups/:group/permissions",
    "title": "Request group permissions list",
    "name": "GetGroupPermissions",
    "group": "GroupPermission",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "group",
            "description": "<p>Group unique ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "size": "1",
            "optional": false,
            "field": "page",
            "description": "<p>Page number</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "size": "15",
            "optional": false,
            "field": "limit",
            "description": "<p>List limit</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object[]",
            "optional": false,
            "field": "permission",
            "description": "<p>List of group permissions.</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "not_found",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "validation_failed",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "missing_role",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "missing_role_permissions",
            "description": ""
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "routes/api.php",
    "groupTitle": "GroupPermission"
  },
  {
    "type": "put",
    "url": "/groups/:id",
    "title": "Update group",
    "name": "UpdateGroup",
    "group": "Group",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Group unique ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "group",
            "description": "<p>object</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "not_found",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "validation_failed",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "missing_role",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "missing_role_permissions",
            "description": ""
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "routes/api.php",
    "groupTitle": "Group"
  },
  {
    "type": "post",
    "url": "/users",
    "title": "Create user",
    "name": "CreateUser",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "size": "4",
            "optional": false,
            "field": "name",
            "description": "<p>User name</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "size": "4",
            "optional": false,
            "field": "email",
            "description": "<p>User email</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "size": "6",
            "optional": false,
            "field": "password",
            "description": "<p>User password</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "size": "6",
            "optional": false,
            "field": "password_confirmation",
            "description": "<p>User password</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "user",
            "description": "<p>object</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "validation_failed",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "missing_role",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "missing_role_permissions",
            "description": ""
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "routes/api.php",
    "groupTitle": "User"
  },
  {
    "type": "delete",
    "url": "/users/:id",
    "title": "Delete user",
    "name": "DeleteUser",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>User unique ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "204": [
          {
            "group": "204",
            "optional": false,
            "field": "Success",
            "description": ""
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "not_found",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "validation_failed",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "missing_role",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "missing_role_permissions",
            "description": ""
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "routes/api.php",
    "groupTitle": "User"
  },
  {
    "type": "get",
    "url": "/users",
    "title": "Request users list",
    "name": "GetUsers",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "size": "1",
            "optional": false,
            "field": "page",
            "description": "<p>Page number</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "size": "15",
            "optional": false,
            "field": "limit",
            "description": "<p>List limit</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object[]",
            "optional": false,
            "field": "user",
            "description": "<p>List of users.</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "validation_failed",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "missing_role",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "missing_role_permissions",
            "description": ""
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "routes/api.php",
    "groupTitle": "User"
  },
  {
    "type": "post",
    "url": "/users/:user/groups",
    "title": "Create or update user groups",
    "name": "CreateUpdateUserGroup",
    "group": "UserGroups",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "user",
            "description": "<p>User unique ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "group",
            "description": "<p>Group object.</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "not_found",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "validation_failed",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "missing_role",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "missing_role_permissions",
            "description": ""
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "routes/api.php",
    "groupTitle": "UserGroups"
  },
  {
    "type": "delete",
    "url": "/users/:user/groups/:group",
    "title": "Delete user group",
    "name": "DeleteUserGroup",
    "group": "UserGroups",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "user",
            "description": "<p>User unique ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "group",
            "description": "<p>Group unique ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "204": [
          {
            "group": "204",
            "optional": false,
            "field": "Success",
            "description": ""
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "not_found",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "missing_role",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "missing_role_permissions",
            "description": ""
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "routes/api.php",
    "groupTitle": "UserGroups"
  },
  {
    "type": "get",
    "url": "/users/:user/groups",
    "title": "Request user groups list",
    "name": "GetUserGroups",
    "group": "UserGroups",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "user",
            "description": "<p>User unique ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "size": "1",
            "optional": false,
            "field": "page",
            "description": "<p>Page number</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "size": "15",
            "optional": false,
            "field": "limit",
            "description": "<p>List limit</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object[]",
            "optional": false,
            "field": "group",
            "description": "<p>List of user groups.</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "not_found",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "validation_failed",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "missing_role",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "missing_role_permissions",
            "description": ""
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "routes/api.php",
    "groupTitle": "UserGroups"
  },
  {
    "type": "put",
    "url": "/users/:id",
    "title": "Update user",
    "name": "UpdateUser",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "size": "4",
            "optional": false,
            "field": "name",
            "description": "<p>User name</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "size": "4",
            "optional": false,
            "field": "email",
            "description": "<p>User email</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "204": [
          {
            "group": "204",
            "optional": false,
            "field": "Success",
            "description": ""
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "not_found",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "validation_failed",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "missing_role",
            "description": ""
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "missing_role_permissions",
            "description": ""
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "routes/api.php",
    "groupTitle": "User"
  }
] });
