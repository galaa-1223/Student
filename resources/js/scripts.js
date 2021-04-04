import Toastify from "toastify-js";

(function (cash) {
    "use strict";

    cash("#remove-image").on("click", function () {
        cash("#preview-image").attr("src", '/dist/images/Blank-avatar.png');
        cash("#remove-image").hide();
        cash("#image").val(null);
        cash("#save_image").hide();
        cash("#cancel_image").hide();
    });

    cash("#image").on("change", function () {

        cash("#save_image").show();
        cash("#cancel_image").show();
        
        var file = cash(this).get(0).files[0];

        if(file){
            var reader = new FileReader();

            reader.onload = function(){
                cash("#preview-image").attr("src", reader.result);
            }

            reader.readAsDataURL(file);
        }

        cash("#remove-image").show();
    });


})(cash);

