<?php include 'core/dbc.php';?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navigation.php'; ?>

<?php //var_dump($_POST); ?>
<?php 
// $sql="SELECT  * FROM virtual_box WHERE title='$username'";
// $result=$db->query($sql);
// $row=$result->fetch_assoc();
// echo $row['title'];
if (!isset($_SESSION['username'])) {
    header('location:sign_in.php');
    exit();
}
?>
<div class="container">
<br>
<br>
<br>
    <form id="fileupload" action="server/php/index.php" method="POST" enctype="multipart/form-data">
        <!-- Redirect browsers with JavaScript disabled to the origin page -->
        <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar">
            <div class="col-lg-7">
                <!-- <label class="title"> -->
                    <!-- <span>Title:</span><br> -->
                    <input type="hidden" name="title[]" value="<?php echo $username; ?>" class="form-control">
                <!-- </label> -->
                
                    <input type="hidden" name="description[]" value="<?php echo $username; ?>" class="form-control">

                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">

                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Add files...</span>
                    <input type="file" name="files[]" multiple>
                    
                </span>
                   
                
                <button type="submit" class="btn btn-primary start">
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start upload</span>
                </button>
                <button type="reset" class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel upload</span>
                </button>

                <?php //$sql="SELECT DISTINCT title FROM virtual_box WHERE title='$username'";
                //$result=$db->query($sql);
                //while($row=$result->fetch_assoc()):
                //extract($row); ?>
            <?php //if ($username==$title): ?>
                
           
                <button type="button" class="btn btn-danger delete">
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" class="toggle">
                <!-- The global file processing state -->
                <span class="fileupload-process"></span>
            </div>
            <!-- The global progress state -->
            <div class="col-lg-5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                </div>
                <!-- The extended global progress state -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" style="background:#fff !important;" class=" table table-striped" >
        <div class="col-md-12 text-center">
        <div class="page-header">
        <h4>Hi, <?=$fname;?>&nbsp;<?=$lname;?> Drag & Drop Your File, Video & Audio Or Upload Manually</h4>
        </div>
        </div>
        <tbody class="files" ></tbody></table>
    </form>
    <br>
   <!--  <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Read this note before upload your file</h3>
        </div>
        <div class="panel-body">
            <ul>
                <li>The maximum file size for uploads in this demo is <strong>999 KB</strong> (default file size is unlimited).</li>
                <li>Only image files (<strong>JPG, GIF, PNG</strong>) are allowed in this demo (by default there is no file type restriction).</li>
                <li>Uploaded files will be deleted automatically after <strong>5 minutes or less</strong> (demo files are stored in memory).</li>
                <li>You can <strong>drag &amp; drop</strong> files from your desktop on this webpage</li>

            </ul>
        </div>
    </div> -->
   
</div>
<!-- The blueimp Gallery widget -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>
<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>

            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade" >
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>

        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}> 

                        {% if (file.type=="image/jpeg" || file.type=="image/png" || file.type=="image/jpg" || file.type=="image/gif") { %}
                         <span>{%=file.name%}</span>&nbsp;&nbsp;
                     <span class="glyphicon glyphicon-fullscreen"></span>
                     {% }
                     else { %}
                     <span>{%=file.name%}</span>&nbsp;&nbsp;
                     <span class="glyphicon glyphicon-download-alt"></span>
                     
                      {% } %}
                      </a>
                {% } else { %}
                    <span>{%=file.name%}</span>

                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td><a href="http://tmuproject.com/virtual-campus/{%=file.title%}" target="_blank">{%=file.title%}</a></td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>{%=file.upload_date%}</td>
        <td>
      
            {% if (file.deleteUrl) { %}
            {% if (file.title=="<?php echo $username ?>") { %}
           
           
          
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
             {% } %}
                <input type="hidden" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}


</script>
<script id="template-upload" type="text/x-tmpl">

{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <!-- ... -->
        <td class="title"><label>Title: <input name="title[]" value="<?php echo $username; ?>"></label></td>

        <!-- ... -->
    </tr>
{% } %}
</script>
<script type="text/javascript">
//     $(document).ready(function(){
//         $('#fileupload').bind('fileuploadsubmit', function (e, data) {
//     var inputs = data.context.find(':input');
//     if (inputs.filter(function () {
//             return !this.value && $(this).prop('required');
//         }).first().focus().length) {
//         data.context.find('button').prop('disabled', false);
//         return false;
//     }
//     data.formData = inputs.serializeArray();
// });
//     })
</script>
<?php include 'includes/footer.php'; ?>
