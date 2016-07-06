$('#sign-up-button').click(function () {
    $('#sign-up').modal();
});

$('.navbar li').click(function(e) {
    $('.navbar li.active').removeClass('active');
    var $this = $(this);
    if (!$this.hasClass('active')) {
        $this.addClass('active');
    }
});

$('.nav-tabs li').click(function(e) {
    $('.nav-tabs li.active').removeClass('active');
    var $this = $(this);

    if($this.index()!=0){
        $('#add-de').hide();
    }else {
        $('#add-de').show();
    }

    if($this.index()!=1){
        $('#view-de').hide();
    }else {
        $('#view-de').show();
    }
    /* J query to only show the ones clicked for panel*/
    if (!$this.hasClass('active')) {
        $this.addClass('active');
    }
});

/* For Experiment Views, hover left synchronize right, right -> left */
$('.rr-both .rr-left').hover(function () {
    var temp = $($(event.target).closest('.rr-both').children()[1]);
    if(temp.hasClass('sync-rr-right')){
        temp.removeClass('sync-rr-right');
    }else{
        temp.addClass('sync-rr-right');
    }
});
$('.rr-both .rr-right').hover(function () {
    var temp = $($(event.target).closest('.rr-both').children()[0]);
    if(temp.hasClass('sync-rr-left')){
        temp.removeClass('sync-rr-left');
    }else{
        temp.addClass('sync-rr-left');
    }
});

/*///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/
/*
 * for dea/deg-dashboard.blade.php
 */
var add_clicked = null;
/*When config/prestertch/layer/material/dimension selected, put the id in the seleced box*/
$(document).on('click','.horizontal .table article',function () {
    //console.log('clicked');
    $(this).fadeOut(250).fadeIn(250);
    var a = $(this).find("input").attr("value");
    var output_tag = ($(this)).parent().parent().parent().parent().find('.output');
    output_tag.fadeOut(250).fadeIn(250);
    (output_tag).val(a);
});
/*Add config/prestertch/layer/material/dimension selected*/
$('.add-1, .add-2, .add-3, .add-4, .add-5').on('click',function () {
    event.preventDefault();
    add_clicked = event.target.parentNode.previousElementSibling.firstElementChild.firstElementChild.firstElementChild;
    var name = ($(event.target)['0'].className);
    $('#'+name).modal();
});

$('#add-1-modal-save, #add-2-modal-save, #add-3-modal-save, #add-4-modal-save, #add-5-modal-save').on('click',function(){
    var id = $(event.target).attr('id');
    var id_num = (id)['4'];

    $(add_clicked).after(
        "<article> <h3> </h3> <h2></h2> <p></p> <input type='hidden' value=''> </article>");

    if(id_num =='4'){
        ($(add_clicked).next().find('h2')).text($('#name-add-4').val());
        ($(add_clicked).next().find('input')).val($('#name-add-4').val());
        $("#add-".concat(id_num)).modal('hide');
    }else if(id_num=='5'){
        ($(add_clicked).next().find('h2')).text($('#name-add-5').val());
        ($(add_clicked).next().find('input')).val($('#name-add-5').val());
        $("#add-".concat(id_num)).modal('hide');
    }
    else{
        var url = "";
        var data_array = {};
        id_num=='1'?url = urlDimension:(id_num=='2'?url=urlConfiguration:url=urlMaterial);
        data_array['name'] = $('#name-add-'.concat(id_num)).val();
        data_array['description'] = $('#description-add-'.concat(id_num)).val();
        data_array['_token'] = token;
        $.ajax({
            method: 'POST',
            url: url,
            data: data_array
        }).done(function(msg){
            //
            if(msg['id']){
                $(add_clicked).next().find('h3').text("ID: "+msg['id']);
                ($(add_clicked).next().find('input')).val(msg['id']);
            }
            if(msg['name']){
                $(add_clicked).next().find('h2').text(msg['name']);
            }
            if(msg['description']){
                $(add_clicked).next().find('p').text(msg['description']);
            }


            $("#add-".concat(id_num)).modal('hide');
        });
    }
});
/*When Dea/Deg selected in view-de*/
var deId = 0;
var panel = "";
$(document).on('click','div.view-DEA div.rr-right, div.view-DEG div.rr-right',function () {
    panel = $(this);
    var tempID = $(this).find('h3')[0].innerHTML;
    deId = tempID.slice(3).trim();
    console.log(deId);
    var dea_deg = $(this).parent()[0].className.slice(-4,-1);
    $('#edit-'+ dea_deg).modal();
});

$(document).on('click','div.view-DEA  div.rr-left, div.view-DEG div.rr-left',function () {
    panel = $(this);
    var tempID = $(this).find('h3')[0].innerHTML;
    deId = tempID.slice(3).trim();
    console.log(deId);
    var dea_deg = $(this).parent()[0].className.slice(-4,-1);
    $('#edit-'+ dea_deg).modal();
});

$('#DEA-delete, #DEG-delete').on('click', function () {
    var url;
    var dea_deg = this.id.slice(0,3);
    dea_deg =='DEA'?url = urlDeleteDEA : url = urlDeleteDEG;
    var modal_hide = "#edit-" + dea_deg;
    console.log(modal_hide);
    console.log(url);

    $.ajax({
            method: 'POST',
            url: url,
            data: {deId: deId, _token: token}
        }
    ).done(function (msg) {
        $(panel).fadeOut(500);
        $(modal_hide).modal('hide');
    })
});
/*///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/
/*
 * for dea/deg-experiment.blade.php
 */
/*Modal for adding Equipment*/
$('.equipment-form .glyphicon').on('click', function () {
    event.preventDefault();
    var equipmentSelects = $(event.target.parentNode).find('select');
    for(i=0; i<5;i++){
        console.log($(equipmentSelects[i]).find('option').first());
    }
    $('#add-equipment').modal();
});
$('#add-equipment-modal-save').on('click',function () {
    $.ajax({
            method: 'POST',
            url: create_equipment_url,
            data: {equipment_name: $('#equipment-name').val() ,equipment_description: $('#equipment-description').val(), _token: token}
        }
    ).done(function (msg) {
        //MAKE UI BETTER
        console.log('finished');
        var newOption =  "<option value="+msg['new_equipment_id']+">"+msg['new_equipment_name']+"</option>";
        var allSelects = $('div.equipment-form select');
        for(var i=0;i<allSelects.length;i++){
            var select = allSelects[i];

            $($(select).find('option')[1]).after(newOption);
        }
        $('#add-equipment').modal('hide');
    })
});

/*Modal for Selecting DEA/DEG*/
$('.form-horizontal .well .select-dea').on('click', function(){
    event.preventDefault();
    $('#select-dea').modal();
});

$(document).on('click','div.modal-dialog div.rr-left',function () {
    //get ID and hide modal
    var input = $('.form-horizontal .well .select-dea').parent().children()[3];
    var selected_id = (($(event.target).closest('div.rr').find('h3'))[0].innerHTML).slice(3).trim();
    $(input).val(selected_id);
    $('#select-dea').modal('hide');
});
$(document).on('click','div.modal-dialog div.rr-right',function () {
    //get ID and hide modal
    var input = $('.form-horizontal .well .select-dea').parent().children()[3];
    var selected_id = (($(event.target).closest('div.rr').find('h3'))[0].innerHTML).slice(3).trim();
    $(input).val(selected_id);
    $('#select-dea').modal('hide');
    //$('#select-dea').modal('hide');
});


var deSelectors = {'dimension_id':-1,'configuration_id':-1,'material_id':-1,'prestretch':-1,'layer':-1};
$('#select-dea div.modal-content .select-dea-table .row select').on('change', function () {
    var selector_name = $(event.target).attr('name');
    var selector_value = $(event.target).val(); //ID for first three, value for last two
    deSelectors[selector_name] = selector_value;
    console.log(deSelectors);
    var dea_array = $('#select-dea .rr');
    for(var i =0; i<dea_array.length;i++){
        console.log('new one');
        var isShow = true;
        if(deSelectors['dimension_id']!=-1){
            $($(dea_array[i]).find('input')[4]).val()==deSelectors['dimension_id']?null:isShow=false;
        }
        if(deSelectors['configuration_id']!=-1){
            $($(dea_array[i]).find('input')[0]).val()==deSelectors['configuration_id']?null:isShow=false;
        }
        if(deSelectors['material_id']!=-1){
            $($(dea_array[i]).find('input')[1]).val()==deSelectors['material_id']?null:isShow=false;
        }
        if(deSelectors['prestretch']!=-1){
            $($(dea_array[i]).find('input')[2]).val()==deSelectors['prestretch']?null:isShow=false;
        }
        if(deSelectors['layer']!=-1){
            $($(dea_array[i]).find('input')[3]).val()==deSelectors['layer']?null:isShow=false;
        }

        if(isShow){
            $(dea_array[i]).css('visibility','visible');
        }else{
            $(dea_array[i]).css('visibility','hidden');
        }

    }
    //for loop, if '-1' or '' ignore that if statement check

});

/*Modal for Creating new Parameter*/
$('.form-horizontal .row .create-parameter').on('click', function(){
    event.preventDefault();
    $('#add-parameter').modal();
});

$('#add-parameter-modal-save').on('click', function () {
    event.preventDefault();
    var name = $('#add-parameter div.modal-body div.form-group input')[0];
    var type = $('#add-parameter div.modal-body div.form-group select')[0];
    var unit = $('#add-parameter div.modal-body div.form-group input')[1];

    var description = $('#add-parameter div.modal-body div.form-group textarea')[0];
    //console.log($(name).val()+' '+$(type).val()+' '+$(unit).val()+ ' '+$(description).val());
    $.ajax({
            method: 'POST',
            url: create_parameter_url,
            data: {parameter_name: $(name).val() ,parameter_description: $(description).val(),parameter_type: $(type).val() ,parameter_unit:$(unit).val(),_token: token}
        }
    ).done(function (msg) {
        //MAKE UI BETTER
        var allSelects = $('div.parameter-form select');
        var newOption = "<option value="+msg['new_parameter_id']+ ">" + msg['new_parameter_name'] +"(" +msg['new_parameter_unit']+")"+"</option>";
        for(var i=0;i<allSelects.length;i++){
            var select = allSelects[i];
            $($(select).find('option')[1]).after(newOption);
        }

        $('#add-parameter').modal('hide');
    })
})


/*Searching for Experiment */
var allParameterChecks=[];//2D array for each experiment [[para1([min, max]) para2...till all parain query box],[....]]
$('.parameters_filter_start_button').click(function () {
    if ($(event.target).text()=='Reset'){
        $('.parameters_filter_tools').hide();
        $(event.target).text('Fileter Experiments!');
        return;
    }

    allParameterChecks = [];
    $('.parameters_filter_tools').show();
    var allPara = $('.parameters_filter_tools').find('.row');
    var length = allPara.length;
    //console.log(length);

    for(var j=0; j<$('.parameters').length; j++){
        var tempParas = {};
        for (var i=0;i<length;i++){
            var tempText = allPara[i].innerText;
            var parsedText = ((tempText).slice(0,tempText.indexOf('<'))).trim();
            tempParas[parsedText] = {'min': true, 'max': true};
        }
        allParameterChecks.push(tempParas);
    }
    console.log(tempParas);
    //console.log(allParameterChecks);
    $(event.target).text('Reset');
});

$('span .max').change(function () {
    //$(event.target).val() is the query value entered.   value = parseFloat(temp.slice(temp.indexOf('=')+1,temp.indexOf('('))) is the parsed value of parameter for each exp
    var experiments = $('.parameters');
    for(var i=0; i<experiments.length; i++){
        allParas = $(experiments[i]).find('li a');
        var pass = false;
        for (var j=0; j<allParas.length;j++){
            var temp = allParas[j].innerText;
            var text = (temp).slice(0,temp.indexOf('='));
            var value = parseFloat(temp.slice(temp.indexOf('=')+1,temp.indexOf('(')));

            if ($(event.target).val()==''){
                pass = true;
                break;
            }
            if(text.trim() == $(event.target).attr('name')){
                if(value<$(event.target).val()){
                    pass = true;
                    break;
                }
            }
        }
        if(pass){
            allParameterChecks[i][$(event.target).attr('name')]['max'] = true;
        }else{
            allParameterChecks[i][$(event.target).attr('name')]['max'] = false;
        }

        var isShow = true;
        for (var key in allParameterChecks[i]){
            if(allParameterChecks[i][key]['min']==false || allParameterChecks[i][key]['max'] == false){
                isShow = false;
            }
        }


        if (isShow){
        //    console.log(experiments[i]);
            $(experiments[i]).show();
            $($(experiments[i]).parent().children()[0]).show();
        }else{
         //   console.log('no way')
            $(experiments[i]).hide();
            $($(experiments[i]).parent().children()[0]).hide();
        }

    }

});
$('span .min').change(function () {
    var experiments = $('.parameters');
    for(var i=0; i<experiments.length; i++){
        allParas = $(experiments[i]).find('li a');//.find('.parameters li a');
        console.log(allParas);
        var pass = false;
        for (var j=0; j<allParas.length;j++){
            var temp = allParas[j].innerText;
            var text = (temp).slice(0,temp.indexOf('='));
            var value = parseFloat(temp.slice(temp.indexOf('=')+1,temp.indexOf('(')));

            if ($(event.target).val()==''){
                pass = true;
                break;
            }
            if(text.trim() == $(event.target).attr('name')){
                if(value>$(event.target).val()){
                    pass = true;
                    break;
                }
            }
        }
        if(pass){
            allParameterChecks[i][$(event.target).attr('name')]['min'] = true;
        }else{
            allParameterChecks[i][$(event.target).attr('name')]['min'] = false;
        }

        var isShow = true;
        for (var key in allParameterChecks[i]){
            if(allParameterChecks[i][key]['min']==false||allParameterChecks[i][key]['max']==false){
                isShow = false;
            }
        }

        if (isShow){
            $(experiments[i]).show();
            $($(experiments[i]).parent().children()[0]).show();
        }else{

            $(experiments[i]).hide();
            $($(experiments[i]).parent().children()[0]).hide();
        }
    }
});


var experimentId = 0;
var experimentToRemove = "";
$(document).on('click','div.view-DEA-Experiment div.rr-right,div.view-DEA-Experiment div.rr-left',function () {
    var temp = $($(event.target).closest('.rr-both').children()[0]);
    experimentToRemove = $(event.target).closest('.rr-both')[0];
    experimentId = temp.find('.experiment-id').text();
    console.log(experimentToRemove);
    $('#edit-Experiment').modal();
});

$('#Experiment-delete').on('click',function () {
    $.ajax({
            method: 'POST',
            url: delete_experiment_url,
            data: {experiment_id: experimentId, _token: token}
        }
    ).done(function (msg) {
        $(experimentToRemove).hide();
        $('#edit-Experiment').modal('hide');
    })
} );


/*///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/
var management_id = 0; //id for edit/delete
var managementNameElement = null;
var managementDescriptionElement = null;
var managementUnitElement = null;
var modal_index = null;
$('.tbl-content tbody tr').on('click',function () {
    event.preventDefault();
    var tr_element = $(event.target).parent();
    var row_array = tr_element.children();
    var class_name = (tr_element.parent())[0].className;

    management_id = row_array[0].innerHTML;
    managementNameElement = row_array[1];
    managementDescriptionElement = row_array[3];
    switch (class_name){
        case 'dimension-tbody': modal_index='1'; break;
        case 'configuration-tbody': modal_index='2';break;
        case 'material-tbody': modal_index='3';break;
        case 'equipment-tbody': modal_index='4';break;
        case 'parameter-tbody': modal_index='5';break;
    }
    // modal
    console.log(managementNameElement.textContent);
    $('#management-name-edit-'+modal_index).val(managementNameElement.textContent);
    $('#management-description-edit-'+modal_index).val(managementDescriptionElement.textContent);
    if (modal_index==5){
        managementUnitElement = row_array[4];
        $('#management-unit-edit-'+modal_index).val(managementUnitElement.textContent);
    }

    $('#management-edit-'+modal_index).modal();
});

$('#management-edit-1-save, #management-edit-2-save, #management-edit-3-save, #management-edit-4-save, #management-edit-5-save').on('click',function(){
    var url = null;
    modal_index=='1'?url = urlEditDimension:(modal_index=='2'?url=urlEditConfiguration:(modal_index=='3'?url = urlEditMaterial:(modal_index=='4'?url=urlEditEquipment:url=urlEditParameter)));
    var data_array = {};
    data_array['id'] = management_id;
    data_array['name'] = $('#management-name-edit-'+modal_index).val();
    data_array['description'] = $('#management-description-edit-'+modal_index).val();
    data_array['_token'] = token;
    management_id=='4'?data_array['unit']=$('#management-unit-edit-'+modal_index).val(): null ;
    $.ajax({
        method:'POST',
        url: url,
        data: data_array
    }).done(function (msg) {
        $(managementNameElement).text(msg['new_name']);
        $(managementDescriptionElement).text(msg['new_description']);
        if (modal_index==5){
            $(managementUnitElement).text(msg['new_unit']);
        }
        $('#management-edit-'+modal_index).modal('hide');
    })
});

$('#management-edit-1-delete, #management-edit-2-delete, #management-edit-3-delete, #management-edit-4-delete, #management-edit-5-delete').on('click',function(){
    var url = null;
    modal_index=='1'?url = urlDeleteDimension:(modal_index=='2'?url=urlDeleteConfiguration:(modal_index=='3'?url = urlDeleteMaterial:(modal_index=='4'?url=urlDeleteEquipment:url=urlDeleteParameter)));
    var data_array = {};
    data_array['id'] = management_id;
    data_array['_token'] = token;
    $.ajax({
        method:'POST',
        url: url,
        data: data_array
    }).done(function (msg) {
        $(managementNameElement).parent().hide();
        $('#management-edit-'+modal_index).modal('hide');
    })
});

/*///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/
var postId = 0;
var postBodyElement = null;
$('.post').find('.interaction').find('.edit').on('click',function () {
    event.preventDefault();

    postBodyElement = event.target.parentNode.parentNode.childNodes[1];
    var postBody = postBodyElement.textContent;
    postId = event.target.parentNode.parentNode.dataset['postid'];
    $('#post-body').val(postBody);
    $('#edit-modal').modal();
})
$('#modal-save').on('click',function () {
    $.ajax({
            method: 'POST',
            url: urlEdit,
            data: {body: $('#post-body').val() ,postId: postId, _token: token}
        }
    ).done(function (msg) {
        //console.log(msg['message']);
        // console.log(JSON.stringify(msg));
        $(postBodyElement).text(msg['new_body']);
        $('#edit-modal').modal('hide');
    })

});