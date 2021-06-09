<script>
    $('#allcheck').click(function(){
        if($(this).is(':checked')){
            $('input[type=checkbox]').prop('checked',true);
        }else{
            $('input[type=checkbox]').prop('checked',false);

        }
    });
    function getPermissionsByGroups(className,checkThis){
        const groupIdName = $('#'+checkThis.id);
        const classCheckBox=$('.'+className+' input');

        if(groupIdName.is(':checked')){
            classCheckBox.prop('checked',true);
        }else{
            classCheckBox.prop('checked',false);

        }
    }
</script>
