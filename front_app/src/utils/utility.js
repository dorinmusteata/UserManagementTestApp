// location
let host = document.location
let hostname = host.hostname

// declare ports
let localhost = 'localhost',
    apiPort = (hostname === localhost) ? ':' + 8000 : '',
    appPort = (hostname === localhost) ? ':' + 8080 : ''

// set protocol for api and app
let apiHost = host.protocol,
    appHost = host.protocol

// set protocol with hostname with port
apiHost += '//' + host.hostname + apiPort + '/api/'
appHost += '//' + host.hostname + appPort

export default {
    apiHost,
    appHost
}