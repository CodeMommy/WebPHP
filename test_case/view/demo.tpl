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

        .left {
            float: left;
        }

        .right {
            float: right;
        }

        .clear {
            clear: both;
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

        .title a {
            color: #fff;
            text-decoration: none;
            background-color: #008cd6;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="title">
        <div class="left">
            <a href="{$root}">CodeMommy WebPHP Demo</a>
        </div>
        <div class="right">
            <label>
                <select id="menu" onchange="">
                    <option value="{$root}">Home</option>
                    {foreach from=$demoList item=demo}
                        {if $demo[0] eq $controller and $demo[1] eq $action}
                            <option value="{$root}{$demo[0]}/{$demo[1]}" selected="selected">
                                {$demo[0]}->{$demo[1]}
                            </option>
                        {else}
                            <option value="{$root}{$demo[0]}/{$demo[1]}">
                                {$demo[0]}->{$demo[1]}
                            </option>
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
