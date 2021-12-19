{* $Id: tracker_validator.tpl 78611 2021-07-05 17:11:28Z jonnybradley $ *}
{if isset($validationjs)}{jq}
$("#editItemForm{{$trackerEditFormId}}").validate({
    {{$validationjs}},
    submitHandler: function(form, event){
        if( typeof nosubmitItemForm{{$trackerEditFormId}} !== "undefined" && nosubmitItemForm{{$trackerEditFormId}} == true ) {
            return false;
        } else {
            return process_submit(form, event);
        }
    }
});
{/jq}{/if}
