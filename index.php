<html>
<head>
    <title>CRUD</title>
    <style>
        body {
            font-family: "HelveticaNeue-Light",
                         "Helvetica Neue Light",
                         "Helvetica Neue",
                         Helvetica,
                         Arial,
                         "Lucida Grande",
                         sans-serif;
            font-weight: 300;
            color: rgb(41, 41, 41);
        }

        input[type="text"],
        input[type="password"],
        input[type="submit"],
        select,
        textarea {
            width: 100%;
        }

        legend {
            font-size: 150%;
        }

        .control-set {
            clear: left;
            padding: 1em;
        }

        .control-set .label {
            width: 23%;
            float: left;
            text-align: right;
            padding-right: 2%;
        }

        .control-set .input {
            width: 50%;
            float: left;
        }

        .control-set .crud-help {
            width: 23%;
            float: left;
            padding-left: 2%;
            color: red;
        }

        #thing-crud-container {
            width:50%;
            float: left;
        }

        #thing-crud-list-container {
            width: 50%;
            float: left;
        }
    </style>
</head>
<body>
    <h1>CRUD</h1>
    <div id="thing-crud-container"></div>
    <div id="thing-crud-list-container"></div>

    <script src="lib/jquery-1.10.2.js"></script>
    <script src="lib/mustache.js"></script>
    <script src="crud.js"></script>
    <script>
        var crud = createCRUD({
            name: 'thing',
            url: 'crud.php',
            validate: function (data) {
                var error = {};
                if(data.text !== 'default') {
                    error.text = 'text error';
                }
                if(data.checkbox !== true) {
                    error.checkbox = 'checkbox error';
                }
                if(data.textarea !== '') {
                    error.textarea = 'textarea error';
                }
                if(data.radio !== 'apple') {
                    error.radio = 'radio error';
                }
                if(data.select !== 'blue') {
                    error.select = 'select error';
                }
                return error;
            },
            schema: {
                text: {
                    type: 'text',
                    value: 'default text'
                },
                password: {
                    type: 'password',
                    value: 'pass'
                },
                textarea: {
                    type: 'textarea',
                    value: 'default textarea'
                },
                fruit: {
                    type: 'checkbox',
                    values: ['apple', 'orange'],
                    value: ['apple', 'orange']
                },
                letter: {
                    type: 'radio',
                    values: ['a', 'b', 'c', 'd'],
                    value: 'c'
                },
                color: {
                    type: 'select',
                    values: ['red', 'yellow', 'blue'],
                    value: ['yellow']
                }
            }
        });
        crud.init();
    </script>
</body>
</html>
