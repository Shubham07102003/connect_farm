
<div class="grey-text center container" style="margin-top:30px;margin-bottom: 10px;margin-left: 20px;width:100%">


    Copyright &copy; <?php echo htmlspecialchars(date('d/m/Y')); ?> Beattle1779. India.<br><br>Developed By 5<>

</div>



</body>
<!-- Compiled and minified JavaScript -->
<script src="js/jquery.js"></script>
<script src="js/mat.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>






<script>

    jQuery(document).ready(function($) {
        $(".clickable-row").dblclick(function() {
            window.location = $(this).data("href");
        });
    });
</script>
<script>
    $(document).ready(function(){

        $('.datepicker').datepicker({

        });

        $('.dropdown-trigger').dropdown({
            hover:true,
        });

    });



</script>

<script>



    $(document).ready(function(){
        $('.sidenav').sidenav();
        $('.collapsible').collapsible();
        $('.collapsible.expandable').collapsible({
            accordion: false
        });

    });

    $(document).ready(function(){
        $('.tooltipped').tooltip();
    });

    $(document).ready(function(){
        $('.tabs').tabs();
    });



  $(document).ready(function(){
    $('.fixed-action-btn').floatingActionButton();
  });
        


</script>


    <script type="text/javascript">
    
    
  //select handeler
  $("select").each( function () {

  if($(this).data('oldsr')){
   $(this).val($(this).data('oldsr'));
  }

  });
    //select handeler
    
    
    
        $(document).ready(function () {
           $('.sortable tbody').sortable({
               update: function (event, ui) {
                   $(this).children().each(function (index) {
                        if ($(this).attr('data-position') != (index+1)) {
                            $(this).attr('data-position', (index+1)).addClass('updated');
                        }
                   });
                   saveNewPositions();
               }
           });
        });

        function saveNewPositions() {
            var positions = [];
            $('.updated').each(function () {
               positions.push([$(this).attr('data-index'), $(this).attr('data-position')]);
               $(this).removeClass('updated');
            });

            $.ajax({
               url: 'view_teacher.php',
               method: 'POST',
               dataType: 'text',
               data: {
                   update___posirions: 1,
                   positions: positions
               }, success: function (response) {
                    console.log(response);
               }
            });
        }
    </script>









</html>