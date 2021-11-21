<?php 
    use Illuminate\Support\Facades\DB;
    $all_permission_group=DB::table('permission_name')->get(); 
?>

<script>
    $("#checkPermissionAll").click(function(){
       if($(this).is(':checked')){
           $('input[type="checkbox"]').prop('checked', true);
       }else{
           $('input[type="checkbox"]').prop('checked', false);
       }
    });
    function checkPermissionByGroup(className, checkThis){
        const groupIdName = $("#"+checkThis.id);
        const classCheckBox = $('.'+className+ ' input');
        if(groupIdName.is(':checked')){
            classCheckBox.prop('checked', true);
        }else{
            classCheckBox.prop('checked', false);
        }
        implementAllChecked()
    }
    function checkSignPermission(groupClassName, groupId, countTotalPermission){
        const classCheckBox = $('.'+groupClassName+' inpute');
        const groupIdCheckBox = $("#"+groupId);
        if($('.'+groupClassName+' input:checked').length == countTotalPermission){
            groupIdCheckBox.prop('checked', true);
        }else{
            groupIdCheckBox.prop('checked', false);
        }
        implementAllChecked()
    }
    function implementAllChecked(){
        const countPermission = {{count($all_permission_group)}};
        const countPermissionGroup = {{count($permissions_groups_id)}};
        console.log(countPermission + countPermissionGroup);
        console.log($('input[type="checkbox"]:checked').length);
        if($('input[type="checkbox"]:checked').length == (countPermission+countPermissionGroup)){
            $("#checkPermissionAll").prop('checked', true);
        }else{
            $("#checkPermissionAll").prop('checked', false);
        }
    }
</script>