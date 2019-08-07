<!doctype html>
<html>
    
    <head>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Product Category Mgt</title>
        
        <script src="<?php echo asset('js/jqueryMinifyV12.js')?>"></script>
        <script src="<?php echo asset('js/bootstrapMin.js')?>"></script>
        <script src="<?php echo asset('js/jqueryBootgridMin.js')?>"></script>
        <script src="<?php echo asset('js/jquery-ui.js')?>"></script>
        
        <link rel="stylesheet" type='text/css' href="<?php echo asset('css/bootstrapMin.css')?>">
        <link rel="stylesheet" type='text/css' href="<?php echo asset('css/jqueryBootgridMin.css')?>">
        <link rel="stylesheet" type='text/css' href="<?php echo asset('css/jquery-ui.css')?>">
        <link rel="stylesheet" type='text/css' href="<?php echo asset('css/siteCustomCss.css')?>">
        
    </head>
    
    <body>
        
        <div id="siteAppDivContainerDivId">
            
            <h2 class='h2CssClass'>
                Product Category Mgt Utility / Features
            </h2>

            <ul class="ulClass">
                <li class='addProdCtgryManuallyProcsLIClass'>
                    Click here to add product category & sub-category [via Manually] process
                </li>
                <li class='addProdCtgryJsonFileProcsLIClass'>
                    Click here to add product category & sub-category [via JsonFile] process
                </li>
            </ul>
            
            <div id='allProdCtgryListingSummaryReportContainerDivId'></div>
            
        </div>
        
        <script>
            
            
            function attachEvntOnHtmlElement(){
                
                try{
                    
                    if($('.addEachProdCtgryAllSubctgryListBtnClass').length>0){
                        
                        $('.addEachProdCtgryAllSubctgryListBtnClass').each(function(){
                            var curBtnObj = $(this);
                            $(curBtnObj).on('click', function(){
                                handleClickEvntOnAddEachProdCtgryAllSubctgryListBtn($(this));
                            });
                        });
                        
                    }
                    
                    if($('.viewEachProdCtgryAllSubctgryListBtnClass').length>0){
                        
                        $('.viewEachProdCtgryAllSubctgryListBtnClass').each(function(){
                            var curBtnObj = $(this);
                            $(curBtnObj).on('click', function(){
                                handleClickEvntOnViewEachProdCtgryAllSubctgryListBtn($(this));
                            });
                        });
                    
                    }
                    
                    if($('.removeEachProdCtgryEachSubctgryBtnClass').length>0){
                        
                        $('.removeEachProdCtgryEachSubctgryBtnClass').each(function(){
                            var curBtnObj = $(this);
                            $(curBtnObj).on('click', function(){
                                handleClickEvntOnRemoveEachProdCtgryEachSubctgryListBtn($(this));
                            });
                        });
                    
                    }
                    
                    
                    if($('.addProdCtgryManuallyProcsLIClass').length>0){
                        
                        $('.addProdCtgryManuallyProcsLIClass').on('click', function(){
                            var curBtnObj = $(this);
                            $(curBtnObj).on('click', function(){
                                handleClickEvntOnAddProdCtgryAllSubctgryListManuallyProcessBtn($(this));
                            });
                        });
                        
                    }
                    
                    if($('.addProdCtgryJsonFileProcsLIClass').length>0){
                        
                        $('.addProdCtgryJsonFileProcsLIClass').on('click', function(){
                            var curBtnObj = $(this);
                            $(curBtnObj).on('click', function(){
                                handleClickEvntOnAddProdCtgryAllSubctgryListJsonFileProcessBtn($(this));
                            });
                        });
                        
                    }
                    
                }catch(ex){
                    console.log("Error occured in func attachEvntOnHtmlElement => " + ex);
                }
                
            }
            
            
            
            function handleClickEvntOnAddProdCtgryAllSubctgryListJsonFileProcessBtn(btnHandlObj){
                
                try{
                    
                    if(btnHandlObj!==false && btnHandlObj!==null){
                        
                        var alertMsgStr = "Task pending to add Product Category with multiple Subcategories through pop-up form format via [JsonFile Process]";
                        alert(alertMsgStr);
                        
                    }
                    
                }catch(ex){
                    console.log("Error occured in func handleClickEvntOnAddProdCtgryAllSubctgryListJsonFileProcessBtn => " + ex);
                }
                
            }
            
            
            function handleClickEvntOnAddProdCtgryAllSubctgryListManuallyProcessBtn(btnHandlObj){
                
                try{
                    
                    if(btnHandlObj!==false && btnHandlObj!==null){
                        
                        var alertMsgStr = "Task pending to add Product Category with multiple Subcategories through pop-up form format via [Manually Process]";
                        alert(alertMsgStr);
                        
                    }
                    
                }catch(ex){
                    console.log("Error occured in func handleClickEvntOnAddProdCtgryAllSubctgryListManuallyProcessBtn => " + ex);
                }
                
            }
            
            
            function updateProdSubCtgryDetails(paramDataObj){
                
                try{
                    
                    if(paramDataObj!==false && paramDataObj!==null){
                        
                        var urlStr = "/updateProdSubCtgryDetails";
                        var ajaxHeadersDataObj = {
                            "X-CSRF-TOKEN" : "<?php echo csrf_token() ?>"
                        };

                        $.ajax({
                            url: urlStr,
                            async:true,
                            type:"POST",
                            data:paramDataObj,
                            headers:ajaxHeadersDataObj,
                            complete:function(rspDataObj){
                                
                                // console.log("rspDataObj => " + JSON.stringify(rspDataObj));
                                var msgStr = "";
                                var responseJSON = rspDataObj.responseJSON;
                                if(responseJSON!=="" && responseJSON!==false && responseJSON!==null){
                                    msgStr = responseJSON.msgArr[0];
                                }
                                
                                alert(msgStr);
                                fetchProductCtgryListSummaryDetails();
                                
                            }
                        });

                    }
                    
                }catch(ex){
                    console.log("Error occured in func updateProdSubCtgryDetails => " + ex);
                }
    
            }
            
            function handleClickEvntOnRemoveEachProdCtgryEachSubctgryListBtn(btnHandlObj){
                
                try{
                    
                    if(btnHandlObj!==false && btnHandlObj!==null){
                        
                        var eachProdCtgryDataObj = $.parseJSON($(btnHandlObj).attr('data-eachprodctgrydataobj'));
                        // console.log("eachProdCtgryDataObj => " + JSON.stringify(eachProdCtgryDataObj));
                        
                        var paramDataObj = {};
                        paramDataObj['prodSubCtgryDataArrOfArr'] = new Array(
                            {
                                "prodSubCtgryId" : eachProdCtgryDataObj['prodCtgrySubCtgryId'],
                                "prodSubCtgryStatus" : "Z",
                                "updatedBy" : "1"
                            }
                        );
                        updateProdSubCtgryDetails(paramDataObj);
                        
                    }
                    
                }catch(ex){
                    console.log("Error occured in func handleClickEvntOnRemoveEachProdCtgryEachSubctgryListBtn => " + ex);
                }
                
            }
            
            
            function handleClickEvntOnAddEachProdCtgryAllSubctgryListBtn(btnHandlObj){
                
                try{
                    
                    if(btnHandlObj!==false && btnHandlObj!==null){
                        
                        var eachProdCtgryDataObj = $.parseJSON($(btnHandlObj).attr('data-eachprodctgrydataobj'));
                        var eachProdCtgryTitle = eachProdCtgryDataObj['prodCtgryName'];
                        var alertMsgStr = "Task pending to add Subcategories of Category [" + eachProdCtgryTitle + "] through pop-up form format";
                        
                        alert(alertMsgStr);
                        
                    }
                    
                }catch(ex){
                    console.log("Error occured in func handleClickEvntOnAddEachProdCtgryAllSubctgryListBtn => " + ex);
                }
                
            }
            
            
            function populateAllProdCtgryAllSubCtgryListDetails(allProdCtgryAllSubCtgryDataArrOfArr){
                
                $('[id^=allProdCtgryAllSubCtgryListingReportDivId_]').remove();
                
                try{
                
                    var jsTimeStampStr = new Date().getTime();
                    var divIdStr = "allProdCtgryAllSubCtgryListingReportDivId_"+jsTimeStampStr;
                    var tblIdStr = "allProdCtgryAllSubCtgryListingReportTblId_"+jsTimeStampStr;
                    var arrLen = 0;
                    var arrIndx = 0;
                    if(allProdCtgryAllSubCtgryDataArrOfArr!==false){
                        arrLen = (allProdCtgryAllSubCtgryDataArrOfArr).length;
                    }
                    
                    $('body').append("<div id='"+divIdStr+"'></div>");
                    
                    var htmlTblStr = "<table id='"+tblIdStr+"' class='table table-condensed table-hover table-striped'>";
                    
                        htmlTblStr+= "<thead>";
                            htmlTblStr+= "<tr>";
                                htmlTblStr+= "<th data-column-id='prodCtgrySubCtgryId' data-type='numeric' data-order='desc'>ID</th>";
                                htmlTblStr+= "<th data-column-id='prodCtgrySubCtgryName'>Name</th>";
                                htmlTblStr+= "<th data-column-id='prodCtgrySubCtgryDescription'>Description</th>";
                                htmlTblStr+= "<th data-column-id='prodCtgrySubCtgryCreatedBy'>Creater</th>";
                                htmlTblStr+= "<th data-column-id='prodCtgrySubCtgryUpdatedBy'>Updater</th>";
                                htmlTblStr+= "<th data-column-id='prodCtgrySubCtgryStatus'>Status</th>";
                                htmlTblStr+= "<th data-column-id='prodCtgrySubCtgryActions' data-formatter='actions'>Actions</th>";
                            htmlTblStr+= "</tr>"; 
                        htmlTblStr+= "</thead>";  
                        
                        htmlTblStr+= "<tbody>";
                        
                            if(arrLen>0){
                                
                                while(arrIndx < arrLen){
                                    
                                    var eachProdCtgryEachSubCtgryDataObj = allProdCtgryAllSubCtgryDataArrOfArr[arrIndx];
                                    
                                    htmlTblStr+= "<tr>";
                                    
                                        htmlTblStr+= "<td>";
                                            htmlTblStr+= eachProdCtgryEachSubCtgryDataObj['prodCtgrySubCtgryId'];
                                        htmlTblStr+= "</td>";
                                        
                                        htmlTblStr+= "<td>";
                                            htmlTblStr+= eachProdCtgryEachSubCtgryDataObj['prodCtgrySubCtgryName'];
                                        htmlTblStr+= "</td>";
                                        
                                        htmlTblStr+= "<td>";
                                            htmlTblStr+= eachProdCtgryEachSubCtgryDataObj['prodCtgrySubCtgryDescription'];
                                        htmlTblStr+= "</td>";
                                        
                                        htmlTblStr+= "<td>";
                                            htmlTblStr+= eachProdCtgryEachSubCtgryDataObj['prodCtgrySubCtgryCreatedBy'];
                                        htmlTblStr+= "</td>";
                                        
                                        htmlTblStr+= "<td>";
                                            htmlTblStr+= eachProdCtgryEachSubCtgryDataObj['prodCtgrySubCtgryUpdatedBy'];
                                        htmlTblStr+= "</td>";
                                        
                                        htmlTblStr+= "<td>";
                                            htmlTblStr+= eachProdCtgryEachSubCtgryDataObj['prodCtgrySubCtgryStatus'];
                                        htmlTblStr+= "</td>";
                                        
                                    htmlTblStr+= "</tr>";
                                    
                                    arrIndx++;
                                    
                                    
                                }
                                
                            }
                        
                        htmlTblStr+= "</tbody>";
                    
                    htmlTblStr+= "</table>";
                    
                    $('#'+divIdStr).empty().append(htmlTblStr);
                    
                    $("#"+tblIdStr).bootgrid({
                        caseSensitive : false,
                        formatters: {
                            "actions": function(column, row){
                                // console.log("Each Row => " + JSON.stringify(row));
                                var btnsStr = "";
                                if(row.prodCtgrySubCtgryStatus === "Active"){
                                    btnsStr = "<input type='submit' class='removeEachProdCtgryEachSubctgryBtnClass' value='Remove' data-eachprodctgrydataobj='"+JSON.stringify(row)+"'>";
                                }
                                return btnsStr;
                            }
                        }
                    }).on("loaded.rs.jquery.bootgrid", function(){
                    
                        attachEvntOnHtmlElement();
                        
                    });
                    
                    $('#'+divIdStr).dialog({
                        autoOpen:false,
                        // height:"auto",
                        width:"800px",
                        modal:true,
                        cache:true,
                        dialogClass:'dlgfixed',
                        title:'Product Subcategory List Window',
                        close:function(event, ui){
                        }
                    });
                    $('#'+divIdStr).dialog('open');
                    $('#'+divIdStr).css({"max-height":"400px", "overflow":"scroll"});
                    
                }catch(ex){
                    console.log("Error occured in func populateAllProdCtgryAllSubCtgryListDetails => " + ex);
                }
                
            }
            
            
            function fetchAllProdCtgryAllSubCtgryListDetails(paramDataObj){
                
                try{
                    
                    if(paramDataObj!==false && paramDataObj!==null){
                        
                        var urlStr = "/getAllProdCtgryAllSubCtgryDetails";
                        var ajaxHeadersDataObj = {
                            "X-CSRF-TOKEN" : "<?php echo csrf_token() ?>"
                        };

                        $.ajax({
                            url: urlStr,
                            async:true,
                            type:"POST",
                            data:paramDataObj,
                            headers:ajaxHeadersDataObj,
                            complete:function(rspDataObj){
                                var allProdCtgryAllSubCtgryDataArrOfArr = false;
                                var responseJSON = rspDataObj.responseJSON;
                                if(responseJSON!=="" && responseJSON!==false && responseJSON!==null){
                                    allProdCtgryAllSubCtgryDataArrOfArr = responseJSON.allProdCtgryAllSubCtgryDataArrOfArr;
                                }
                                // console.log("On complete fetchAllProdCtgryAllSubCtgryListDetails => " + JSON.stringify(allProdCtgryAllSubCtgryDataArrOfArr));
                                populateAllProdCtgryAllSubCtgryListDetails(allProdCtgryAllSubCtgryDataArrOfArr);
                            }
                        });

                    }
                    
                }catch(ex){
                    console.log("Error occured in func fetchAllProdCtgryAllSubCtgryListDetails => " + ex);
                }
    
            }
            
            
            function handleClickEvntOnViewEachProdCtgryAllSubctgryListBtn(btnHandlObj){
                
                try{
                    
                    if(btnHandlObj!==false && btnHandlObj!==null){
                        
                        var eachProdCtgryDataObj = $.parseJSON($(btnHandlObj).attr('data-eachprodctgrydataobj'));
                        // console.log("eachProdCtgryDataObj => " + JSON.stringify(eachProdCtgryDataObj));
                        
                        var paramDataObj = {};
                        paramDataObj['prodCtgryIds'] = eachProdCtgryDataObj['prodCtgryId'];
                        fetchAllProdCtgryAllSubCtgryListDetails(paramDataObj);
                        
                    }
                    
                }catch(ex){
                    console.log("Error occured in func handleClickEvntOnViewEachProdCtgryAllSubctgryListBtn => " + ex);
                }
                
            }
            
            function populateProdCtgryListSummaryDetails(allProdCtgrySummaryDataArrOfArr){
                
                $('#allProdCtgryListingSummaryReportContainerDivId').empty();
                
                try{
                    
                    var jsTimeStampStr = new Date().getTime();
                    var tblIdStr = "allProdCtgryListingSummaryReportTblId_"+jsTimeStampStr;
                    // var tblIdStr = "grid-data";
                    var arrLen = 0;
                    var arrIndx = 0;
                    if(allProdCtgrySummaryDataArrOfArr!==false){
                        arrLen = (allProdCtgrySummaryDataArrOfArr).length;
                    }
                    
                    var htmlTblStr = "<table id='"+tblIdStr+"' class='table table-condensed table-hover table-striped'>";
                    
                        htmlTblStr+= "<thead>";
                            htmlTblStr+= "<tr>";
                                htmlTblStr+= "<th data-column-id='prodCtgryId' data-type='numeric' data-order='desc'>Ctgry-ID</th>";
                                htmlTblStr+= "<th data-column-id='prodCtgryName'>Ctgry Name</th>";
                                htmlTblStr+= "<th data-column-id='prodCtgryImgName'>Ctgry Img</th>";
                                htmlTblStr+= "<th data-column-id='cntOfProdCtgrySubCtgry'>Total Subctgry</th>";
                                htmlTblStr+= "<th data-column-id='cntOfProdSubCtgryStatusActive'>Subctgry [Active]</th>";
                                htmlTblStr+= "<th data-column-id='cntOfProdSubCtgryStatusInactive'>Subctgry [Inactive]</th>";
                                htmlTblStr+= "<th data-column-id='prodCtgryCreatedBy'>Ctgry Creater</th>";
                                htmlTblStr+= "<th data-column-id='prodCtgryStatus'>Ctgry Status</th>";
                                htmlTblStr+= "<th data-column-id='prodCtgryActions' data-formatter='actions'>Actions</th>";
                            htmlTblStr+= "</tr>"; 
                        htmlTblStr+= "</thead>";  
                        
                        htmlTblStr+= "<tbody>";
                        
                            if(arrLen>0){
                                
                                while(arrIndx < arrLen){
                                    
                                    var eachProdCtgryDataObj = allProdCtgrySummaryDataArrOfArr[arrIndx];
                                    
                                    htmlTblStr+= "<tr>";
                                    
                                        htmlTblStr+= "<td>";
                                            htmlTblStr+= eachProdCtgryDataObj['prodCtgryId'];
                                        htmlTblStr+= "</td>";
                                        
                                        htmlTblStr+= "<td>";
                                            htmlTblStr+= eachProdCtgryDataObj['prodCtgryName'];
                                        htmlTblStr+= "</td>";
                                        
                                        htmlTblStr+= "<td>";
                                            htmlTblStr+= eachProdCtgryDataObj['prodCtgryImgName'];
                                        htmlTblStr+= "</td>";
                                        
                                        htmlTblStr+= "<td>";
                                            htmlTblStr+= eachProdCtgryDataObj['cntOfProdCtgrySubCtgry'];
                                        htmlTblStr+= "</td>";
                                        
                                        htmlTblStr+= "<td>";
                                            htmlTblStr+= eachProdCtgryDataObj['cntOfProdSubCtgryStatusActive'];
                                        htmlTblStr+= "</td>";
                                        
                                        htmlTblStr+= "<td>";
                                            htmlTblStr+= eachProdCtgryDataObj['cntOfProdSubCtgryStatusInactive'];
                                        htmlTblStr+= "</td>";
                                        
                                        htmlTblStr+= "<td>";
                                            htmlTblStr+= eachProdCtgryDataObj['prodCtgryCreatedBy'];
                                        htmlTblStr+= "</td>";
                                        
                                        htmlTblStr+= "<td>";
                                            htmlTblStr+= eachProdCtgryDataObj['prodCtgryStatus'];
                                        htmlTblStr+= "</td>";
                                        
                                        htmlTblStr+= "<td>";
                                            htmlTblStr+= "";
                                        htmlTblStr+= "</td>";
                                        
                                    htmlTblStr+= "</tr>";
                                    
                                    arrIndx++;
                                    
                                    
                                }
                                
                            }
                        
                        htmlTblStr+= "</tbody>";
                    
                    htmlTblStr+= "</table>";
                    
                    $('#allProdCtgryListingSummaryReportContainerDivId').empty().append(htmlTblStr);
                    
                    $("#"+tblIdStr).bootgrid({
                        caseSensitive : false,
                        formatters: {
                            "actions": function(column, row){
                                // console.log("Each Row => " + JSON.stringify(row));
                                var btnsStr = "<input type='submit' class='addEachProdCtgryAllSubctgryListBtnClass' value='Add' data-eachprodctgrydataobj='"+JSON.stringify(row)+"'>";
                                btnsStr+= "<input type='submit' class='viewEachProdCtgryAllSubctgryListBtnClass' value='View' data-eachprodctgrydataobj='"+JSON.stringify(row)+"'>";
                                return btnsStr;
                            }
                        }
                    }).on("loaded.rs.jquery.bootgrid", function(){
                    
                        attachEvntOnHtmlElement();
                        
                    });
                    
                }catch(ex){
                    console.log("Error occured in func fetchProductCtgryListSummaryDetails => " + ex);
                }
                
            }
            
            
            function fetchProductCtgryListSummaryDetails(){
                
                $('#allProdCtgryListingSummaryReportContainerDivId').empty();
                $('[id^=allProdCtgryAllSubCtgryListingReportDivId_]').remove();
                
                try{

                    var urlStr = "/getAllProdCtgrySummaryDetails";
                    var ajaxHeadersDataObj = {
                        "X-CSRF-TOKEN" : "<?php echo csrf_token() ?>"
                    };
                    var jsonParamObj = {};
                    jsonParamObj['prodCtgryIds'] = "";
                
                    $.ajax({
                        url: urlStr,
                        async:true,
                        type:"POST",
                        data:jsonParamObj,
                        headers:ajaxHeadersDataObj,
                        complete:function(rspDataObj){
                            var allProdCtgrySummaryDataArrOfArr = false;
                            var responseJSON = rspDataObj.responseJSON;
                            if(responseJSON!=="" && responseJSON!==false && responseJSON!==null){
                                allProdCtgrySummaryDataArrOfArr = responseJSON.allProdCtgrySummaryDataArrOfArr;
                            }
                            // console.log("On complete fetchProductCtgryListSummaryDetails => " + JSON.stringify(allProdCtgrySummaryDataArrOfArr));
                            populateProdCtgryListSummaryDetails(allProdCtgrySummaryDataArrOfArr);
                        }
                    });

                }catch(ex){
                    console.log("Error occured in func fetchProductCtgryListSummaryDetails => " + ex);
                }
    
            }
            
            $(document).ready(function(e){
                
                try{
                    
                    fetchProductCtgryListSummaryDetails();
                    
                }catch(ex){
                    console.log("Error occured in func documentReady => " + ex);
                }
                
            });

        </script>    
        
    </body>
    
</html>