<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
    <link href="first.css"
        rel="stylesheet" type="text/css" />
    <link href="last.css"
        rel="Stylesheet" type="text/css" />
    <script src="first.js"></script>
    <script src="last.js" type="text/javascript"></script>
    <script type="text/javascript">


        $(function () {  
            $('#datepicker').datepicker({
                minDate: "0",
                changeMonth: true,
                changeYear: true

            });

        });

    </script>
</head>
<body>
    <form id="form1" runat="server">
                    <input type="text" id="datepicker" /></p>
    </form>
</body>
</html>