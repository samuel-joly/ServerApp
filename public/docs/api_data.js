define({ "api": [
  {
    "type": "post",
    "url": "/admin/user/",
    "title": "Create user",
    "name": "createUser",
    "group": "Admin",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>The new user's name</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>The new user's password</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Controllers/User.php",
    "groupTitle": "Admin",
    "sampleRequest": [
      {
        "url": "http://82.66.65.201:5555/admin/user/"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": true,
            "field": "message",
            "description": "<p>The message returned</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": true,
            "field": "data",
            "description": "<p>The data</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "/auth",
    "title": "Authenticate user",
    "name": "login",
    "group": "Authentification",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>The new user's e-mail</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>The new user's password</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Controllers/Auth.php",
    "groupTitle": "Authentification",
    "sampleRequest": [
      {
        "url": "http://82.66.65.201:5555/auth"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>The message returned</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "user",
            "description": "<p>The user data</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>The JWT token for authentication</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "/auth/register",
    "title": "Register new user",
    "name": "register",
    "group": "Authentification",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>The new user's name</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>The new user's password</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "passwordConfirm",
            "description": "<p>The new user's password confirmation</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Controllers/Auth.php",
    "groupTitle": "Authentification",
    "sampleRequest": [
      {
        "url": "http://82.66.65.201:5555/auth/register"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>The message returned</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "user",
            "description": "<p>The user data</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>The JWT token for authentication</p>"
          }
        ]
      }
    }
  },
  {
    "type": "get",
    "url": "/database",
    "title": "Get Databases",
    "name": "index",
    "group": "Database",
    "version": "0.0.0",
    "filename": "app/Controllers/Database.php",
    "groupTitle": "Database",
    "sampleRequest": [
      {
        "url": "http://82.66.65.201:5555/database"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": true,
            "field": "message",
            "description": "<p>The message returned</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": true,
            "field": "data",
            "description": "<p>The data</p>"
          }
        ]
      }
    }
  },
  {
    "type": "get",
    "url": "/database/tables",
    "title": "Get tables from database",
    "name": "index",
    "group": "Database",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "database",
            "description": "<p>name</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Controllers/Database.php",
    "groupTitle": "Database",
    "sampleRequest": [
      {
        "url": "http://82.66.65.201:5555/database/tables"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": true,
            "field": "message",
            "description": "<p>The message returned</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": true,
            "field": "data",
            "description": "<p>The data</p>"
          }
        ]
      }
    }
  },
  {
    "type": "get",
    "url": "/database/describe",
    "title": "Get tables infos from database",
    "name": "index",
    "group": "Database",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "database",
            "description": "<p>name</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "table",
            "description": "<p>name</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Controllers/Database.php",
    "groupTitle": "Database",
    "sampleRequest": [
      {
        "url": "http://82.66.65.201:5555/database/describe"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": true,
            "field": "message",
            "description": "<p>The message returned</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": true,
            "field": "data",
            "description": "<p>The data</p>"
          }
        ]
      }
    }
  },
  {
    "type": "get",
    "url": "/log",
    "title": "Get logs",
    "name": "index",
    "group": "Log",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Object",
            "optional": true,
            "field": "filter",
            "description": "<p>A json object with filter as { response_status : 200 , hostname : &quot;125.168.1.26&quot;}</p>"
          },
          {
            "group": "Parameter",
            "type": "Int",
            "optional": true,
            "field": "limit",
            "description": "<p>The number of returned logs, return all logs if 0</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "service",
            "description": "<p>The name of the requested service's logs</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Controllers/Log.php",
    "groupTitle": "Log",
    "sampleRequest": [
      {
        "url": "http://82.66.65.201:5555/log"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": true,
            "field": "message",
            "description": "<p>The message returned</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": true,
            "field": "data",
            "description": "<p>The data</p>"
          }
        ]
      }
    }
  },
  {
    "type": "delete",
    "url": "/user/:id",
    "title": "Delete user",
    "name": "delete",
    "group": "Users",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>The user ID</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Controllers/User.php",
    "groupTitle": "Users",
    "sampleRequest": [
      {
        "url": "http://82.66.65.201:5555/user/:id"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": true,
            "field": "message",
            "description": "<p>The message returned</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": true,
            "field": "data",
            "description": "<p>The data</p>"
          }
        ]
      }
    }
  },
  {
    "type": "get",
    "url": "/user",
    "title": "Get users",
    "name": "index",
    "group": "Users",
    "version": "0.0.0",
    "filename": "app/Controllers/User.php",
    "groupTitle": "Users",
    "sampleRequest": [
      {
        "url": "http://82.66.65.201:5555/user"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": true,
            "field": "message",
            "description": "<p>The message returned</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": true,
            "field": "data",
            "description": "<p>The data</p>"
          }
        ]
      }
    }
  },
  {
    "type": "get",
    "url": "/user/:id",
    "title": "Get user",
    "name": "show",
    "group": "Users",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>The user ID</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Controllers/User.php",
    "groupTitle": "Users",
    "sampleRequest": [
      {
        "url": "http://82.66.65.201:5555/user/:id"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": true,
            "field": "message",
            "description": "<p>The message returned</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": true,
            "field": "data",
            "description": "<p>The data</p>"
          }
        ]
      }
    }
  },
  {
    "type": "put",
    "url": "/user/:id",
    "title": "Update user",
    "name": "update",
    "group": "Users",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>The user ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "username",
            "description": "<p>The user's new name</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "password",
            "description": "<p>The user's new password</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Controllers/User.php",
    "groupTitle": "Users",
    "sampleRequest": [
      {
        "url": "http://82.66.65.201:5555/user/:id"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": true,
            "field": "message",
            "description": "<p>The message returned</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": true,
            "field": "data",
            "description": "<p>The data</p>"
          }
        ]
      }
    }
  }
] });
