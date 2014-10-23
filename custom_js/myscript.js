// JavaScript Document

//Javascript code
$(function(){
$( "input#print" )
.attr( "href", "javascript:void( 0 )" )
.click(function(){
$( "#printable" ).print();
return( false );
});
});



<!-- dialog box script--> 


        $(document).ready(function ()
        {
            $("#btnShowSimple").click(function (e)
            {
                ShowDialog(false);
                e.preventDefault();
            });
           $("#btnClose1").click(function (e)
            {
                HideDialog();
                e.preventDefault();
            });
            

            $("#btnClose").click(function (e)
            {
                HideDialog();
                e.preventDefault();
            });

            $("#btnSubmit").click(function (e)
            {
                var brand = $("#brands input:radio:checked").val();
                $("#output").html("Your favorite mobile brand: " + brand);
                HideDialog();
                e.preventDefault();
            });
        });

        function ShowDialog(modal)
        {
            $("#overlay").show();
            $("#dialog").fadeIn(300);

            if (modal)
            {
                $("#overlay").unbind("click");
            }
            else
            {
                $("#overlay").click(function (e)
                {
                    HideDialog();
                });
            }
        }

        function HideDialog()
        {
            $("#overlay").hide();
            $("#dialog").fadeOut(300);
        } 
        




