<?php
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="V3ctor Warehouse for MySQL">
    <meta name="author" content="YoRcH">

    <title>V3ctor Warehouse</title>

    <link href="data:image/x-icon;base64,AAABAAEAEBAAAAEAIABoBAAAFgAAACgAAAAQAAAAIAAAAAEAIAAAAAAAAAQAABILAAASCwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAGwAAALkAAAD4AAAAzQAAADIAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAALgAAAD/AAAA/wAAAP8AAADgAAAABQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAEAAAD1AAAA/wAAAP8AAAD/AAAA/wAAACUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAEAAABUAAAA9wAAAP8AAAD/AAAA/wAAAO4AAAAKAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADAAAAC/AAAA1AAAAGgAAADgAAAA/wAAAO8AAABQAAAAAAAAAAAAAAAEAAAAYgAAAI8AAABRAAAAFQAAAJgAAADqAAAAbgAAAAUAAAAAAAAABgAAACYAAAALAAAAAAAAAAAAAAAAAAAAogAAAP8AAAD/AAAA/wAAAPMAAACWAAAAFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAFwAAAP0AAAD/AAAA/wAAAP8AAADtAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABcAAAD9AAAA/wAAAP8AAAD/AAAA8AAAAAIAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAowAAAP8AAAD/AAAA/wAAAOwAAAC3AAAAKgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAABjAAAAkAAAAFIAAAAIAAAAdgAAAOwAAACQAAAAEgAAAAAAAAAFAAAAJQAAAAoAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAZAAAAngAAAOgAAAB9AAAA4AAAAP8AAADvAAAAUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA1AAAA8wAAAP8AAAD/AAAA/wAAAO4AAAAKAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAPUAAAD/AAAA/wAAAP8AAAD/AAAAJQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAC4AAAA/wAAAP8AAAD/AAAA4AAAAAYAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAHAAAALoAAAD5AAAAzgAAADMAAAAA/8EAAP/AAAD/gAAA/wAAAP4BAACAIwAAAP8AAAH/AAAB/wAAAP8AAIAjAAD+AQAA/4AAAP+AAAD/wAAA/8EAAA==" rel="icon" type="image/x-icon">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flat-ui/2.3.0/css/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flat-ui/2.3.0/css/flat-ui.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flat-ui/2.3.0/js/flat-ui.min.js"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
      body {
        padding-top: 20px;
        padding-bottom: 20px;
      }

      .jumbotron {
      	background-color: #ffffff;
      }

      .modal {
        text-align: center;
        padding: 0!important;
      }

      .modal:before {
        content: '';
        display: inline-block;
        height: 100%;
        vertical-align: middle;
        margin-right: -4px;
      }

      .modal-dialog {
        display: inline-block;
        text-align: left;
        vertical-align: middle;
      }

      .modal.fade .modal-dialog {
        -webkit-transform: scale(0.1);
        -moz-transform: scale(0.1);
        -ms-transform: scale(0.1);
        transform: scale(0.1);
        top: 300px;
        opacity: 0;
        -webkit-transition: all 0.3s;
        -moz-transition: all 0.3s;
        transition: all 0.3s;
      }

      .modal.fade.in .modal-dialog {
        -webkit-transform: scale(1);
        -moz-transform: scale(1);
        -ms-transform: scale(1);
        transform: scale(1);
        -webkit-transform: translate3d(0, -300px, 0);
        transform: translate3d(0, -300px, 0);
        opacity: 1;
      }
    </style>
    <script type="text/javascript">
      jProp = {};
      reloadPage = false;

      function showMsg(msg, type) {
        if (type == 1) {
          $("#btnMsg").removeClass("btn-danger");
          $("#btnMsg").addClass("btn-primary");
        }
        else {
          $("#btnMsg").removeClass("btn-primary");
          $("#btnMsg").addClass("btn-danger");
        }

        $("#txtMsg").html(msg);

        $("#winMsg").modal({
          backdrop: 'static',
          keyboard: false
        });
      }

      function showProp() {
        $("#txtPropName").val("");

        $("#winProp").modal({
          backdrop: 'static',
          keyboard: false
        }); 
      }

      function delProp(propName) {
        jTemp = {};

        for(var p in jProp) {
          if (p != propName) {
            jTemp[p] = jProp[p];
          }
        }

        jProp = jTemp;

        showGrid();
      }

      function showGrid() {
        var html = "";

        for(var p in jProp) {
          html = html + "<tr><td>" + p + "</td>";
          html = html + "<td>" + jProp[p] + "</td>";
          html = html + '<td><button class="btn btn-sm btn-danger" onclick=delProp("' + p + '")> <b>Remove</b></button></td></tr>';
        }

        $("#grdProp").html(html);
      }

      function createEntity() {
        var entName = $("#txtEntity").val();

        if (entName == "") {
          showMsg("You must type entity name", 2);
          return false;
        }

        if (jsonLen() == 0) {
          showMsg("You must add properties", 2);
          return false;
        }

        var url = 'create.php?entity=' + entName;

        $.post(url, 
          JSON.stringify(jProp), 
          function(response, status){
            if (status == "success"){
              reloadPage = true;
              showMsg(response["msg"], 1);
            }
          }).error(function(error){
                                  console.log(error);
                              });
      }

      function jsonLen() {
        var t = 0;

        for(var p in jProp) {
          t++;
        }

        return t;
      }

      // Init Jquery
      $(document).ready( function() {
       
        $("#btnAdd").click(function() {
          showProp();
        });

        $("#btnProp").click(function() {
          var propName = $("#txtPropName").val();

          if (propName == "") {
            showMsg("You must type property name", 2);
            return false;
          }

          if (jProp[propName]) {
            showMsg("Property name already exists", 2);
            return false;
          }
          else {
            jProp[propName] = $("#cmbPropType").val();
            showGrid();
            $("#winProp").modal("hide");
            $("#btnCreate").prop("disabled", false);
          }
        });

        $("#btnCreate").click(function() {
          createEntity();
        });

        $("#btnMsg").click(function() {
          if(reloadPage)
            window.location.reload();
        });

      });      
    </script>
  </head>

  <body>
    <div class="container">
		  <center>
    		<h3>V3ctor WareHouse for MySQL</h3>
        <h4>SDKs</h4>
        <a href="https://github.com/yorch81/v3sdk_java" target="_blank"><i class="fab fa-java fa-3x"></i></a>&nbsp;&nbsp;&nbsp;
        <a href="https://github.com/yorch81/v3sdk_js" target="_blank"><i class="fab fa-js fa-3x"></i></a>&nbsp;&nbsp;&nbsp;
        <a href="https://github.com/yorch81/v3sdk_android" target="_blank"><i class="fab fa-android fa-3x"></i></a>&nbsp;&nbsp;&nbsp;
        <a href="https://github.com/yorch81/v3sdk" target="_blank"><i class="fab fa-php fa-3x"></i></a>&nbsp;&nbsp;&nbsp;
        <a href="https://github.com/yorch81/v3sdk_net" target="_blank"><i class="fab fa-microsoft fa-3x"></i></a>
        <br>
    	</center>

    	<div class="container">
        <p>V3ctor URL = <b>http://yorch.tk/v3ctorwh/api/</b></p>
        <p>V3ctor KEY = <b>qjnVYHaFmDAcvc5r2JoYta2EJ9yhPi</b></p>

    		<h5>Entity</h5>
    		<div class="form-inline">
    			<div class='input-group'>
    				<span class="input-group-addon">v3_</span>
            <input id="txtEntity" type="text " class="form-control" placeholder="Entity name" name="txtEntity" value="">
          </div>
    		</div>
        <br>
        <button id="btnAdd" class="btn btn-primary">Add property</button>
    		<br>
        <h5>Properties</h5>
    		<div class="container">
    			<table class="table">
            <thead>
              <tr>
                <th>Property</th>
                <th>Type</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="grdProp">
            </tbody>
          </table>
    		</div>
        <br>
        <button id="btnCreate" class="btn btn-primary" disabled="true">Add entity</button>
		  </div>      
    </div>

    <div class="modal fade" id="winProp" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <label for="txtPropName">Property name:</label>
            <input type="text" name="propName" class="form-control" id="txtPropName" placeholder="Property name" required>
            <br>
            <label for="cmbPropType">Property type:</label>
            <select id='cmbPropType' class='form-control' name='propType'>
              <option vale="TEXT">TEXT</option>
              <option vale="INTEGER">INTEGER</option>
              <option vale="DECIMAL">DECIMAL</option>
              <option vale="DATETIME">DATETIME</option>
            </select>
            <br>
            <center>
              <button class="btn btn-danger" data-dismiss="modal"> <b>Cancel</b></button>
              <button id="btnProp" class="btn btn-primary"> <b>Add</b></button>
            </center>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="winMsg" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <p id="txtMsg">Alert Message</p>
            <br/>
            <center>
              <button id="btnMsg" class="btn btn-primary" data-dismiss="modal"> <b>Ok</b></button>
            </center>
          </div>
        </div>
      </div>
    </div>

  </body>
</html>
