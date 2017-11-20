<!DOCTYPE html>
<html>
<head>
    <title>{$title}</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=0">
    <style>
        * {
            -webkit-tap-highlight-color: transparent;
            font-family: "Microsoft YaHei", Arial, Helvetica, sans-serif;
        }

        body {
            padding-top: 40px;
            background-color: #ddd;
        }

        .container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
        }

        .title {
            background-color: #008cd6;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        .title select {
            border: none;
        }

        .left {
            float: left;
        }

        .right {
            float: right;
        }

        .clear {
            clear: both;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="title">
        <div class="left">CodeMommy WebPHP Test</div>
        <div class="right">
            <label>
                <select id="menu" onchange="">
                    <option value="/">Home</option>
                    {foreach from=$testList item=test}
                        {if $test eq $action}
                            <option value="/{$test}" selected="selected">{$test}</option>
                        {else}
                            <option value="/{$test}">{$test}</option>
                        {/if}
                    {/foreach}
                </select>
            </label>
        </div>
        <div class="clear"></div>
    </div>
</div>
<script>
    window.onload = function () {
        document.getElementById('menu').addEventListener('input', function () {
            window.location.href = this.value;
        }, false);
    };
</script>
</body>
</html>
