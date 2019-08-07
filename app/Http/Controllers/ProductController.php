<?php

## namespace App\Http\Controllers;
### use Illuminate\Http\Request;

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class ProductController extends Controller{
    
    
    public function getAllProdCtgrySummaryDetails(Request $request){
        
        $rspDataObj = array(
            'allProdCtgrySummaryDataArrOfArr'=> false,
            'msgArr' => array("No product category summary details were found")
        );
        
        try{
            
            ### extracted parameter data
            $prodCtgryIds = $request->prodCtgryIds;
        
            ### preparing queries
            $selectQryStmtStr = "SELECT";
            $selectQryStmtStr.= "   c.id prodCtgryId, 
                                    c.name prodCtgryName, 
                                    c.img_name prodCtgryImgName,
                                    COUNT(sc.id) cntOfProdCtgrySubCtgry,
                                    (CASE 
                                        WHEN c.status='A' THEN 'Active'
                                        ELSE 'Inactive'
                                    END) prodCtgryStatus,
                                    COALESCE(SUM(
                                        CASE 
                                            WHEN sc.status = 'A' THEN '1'
                                            ELSE '0'
                                        END    
                                    ), 0) cntOfProdSubCtgryStatusActive,
                                    COALESCE(SUM(
                                        CASE 
                                            WHEN sc.status = 'Z' THEN '1'
                                            ELSE '0'
                                        END    
                                    ), 0) cntOfProdSubCtgryStatusInactive,
                                    COALESCE((
                                        SELECT
                                        u.full_name
                                        FROM USER u
                                        WHERE 1
                                        AND u.id = c.created_by
                                        LIMIT 1
                                    ), '') prodCtgryCreatedBy";
            $selectQryStmtStr.= " FROM CATEGORY c
                                  JOIN SUB_CATEGORY sc ON sc.category_id = c.id
                                  WHERE 1";
                                if($prodCtgryIds!=""){
                                   $selectQryStmtStr.= " AND c.id IN ($prodCtgryIds) AND sc.category_id IN ($prodCtgryIds)"; 
                                }
            $selectQryStmtStr.= " GROUP BY c.id"; 

            ### fetching query output
            $allProdCtgrySummaryDataArrOfArr = DB::select($selectQryStmtStr);
            
            ### storing response data
            $rspDataObj['allProdCtgrySummaryDataArrOfArr'] = $allProdCtgrySummaryDataArrOfArr;
            if($allProdCtgrySummaryDataArrOfArr!=false && $allProdCtgrySummaryDataArrOfArr!=null){
                $rspDataObj['msgArr'] = array("Product category summary details were found");
            }
        
        }catch(Exception $ex){
            
            $rspDataObj['allProdCtgrySummaryDataArrOfArr'] = false;
            $rspDataObj['msgArr'] = array("Exception occured while fetching product category summary details");
            
        }
        
        ### returning response
        return response()->json($rspDataObj, 200);
        
    }
    
    
    public function getAllProdCtgryAllSubCtgryDetails(Request $request){
        
        $rspDataObj = array(
            'allProdCtgryAllSubCtgryDataArrOfArr'=> false,
            'msgArr' => array("No product category with subcategory details were found")
        );
        
        try{
            
            ### extracted parameter data
            $prodCtgryIds = $request->prodCtgryIds;
        
            ### preparing queries
            $selectQryStmtStr = "SELECT";
            $selectQryStmtStr.= "   c.id prodCtgryId, 
                                    c.name prodCtgryName, 
                                    c.img_name prodCtgryImgName,
                                    (CASE 
                                      WHEN c.status='A' THEN 'Active'
                                      ELSE 'Inactive'
                                    END) prodCtgryStatus,
                                    sc.id prodCtgrySubCtgryId, 
                                    sc.name prodCtgrySubCtgryName, 
                                    sc.description prodCtgrySubCtgryDescription,
                                    (CASE 
                                      WHEN sc.status='A' THEN 'Active'
                                      ELSE 'Inactive'
                                    END) prodCtgrySubCtgryStatus,
                                    COALESCE((
                                        SELECT
                                        u.full_name
                                        FROM USER u
                                        WHERE 1
                                        AND u.id = sc.created_by
                                        LIMIT 1
                                    ), '') prodCtgrySubCtgryCreatedBy,
                                    COALESCE((
                                        SELECT
                                        u.full_name
                                        FROM USER u
                                        WHERE 1
                                        AND u.id = sc.updated_by
                                        LIMIT 1
                                    ), '') prodCtgrySubCtgryUpdatedBy";
            $selectQryStmtStr.= " FROM CATEGORY c
                                  JOIN SUB_CATEGORY sc ON sc.category_id = c.id
                                  WHERE 1";
                                if($prodCtgryIds!=""){
                                   $selectQryStmtStr.= " AND c.id IN ($prodCtgryIds) AND sc.category_id IN ($prodCtgryIds)"; 
                                }

            ### fetching query output
            $allProdCtgryAllSubCtgryDataArrOfArr = DB::select($selectQryStmtStr);
            
            ### storing response data
            $rspDataObj['allProdCtgryAllSubCtgryDataArrOfArr'] = $allProdCtgryAllSubCtgryDataArrOfArr;
            if($allProdCtgryAllSubCtgryDataArrOfArr!=false && $allProdCtgryAllSubCtgryDataArrOfArr!=null){
                $rspDataObj['msgArr'] = array("Product category with subcategory details were found");
            }
        
        }catch(Exception $ex){
            
            $rspDataObj['allProdCtgryAllSubCtgryDataArrOfArr'] = false;
            $rspDataObj['msgArr'] = array("Exception occured while fetching product category with subcategory details");
            
        }
        
        ### returning response
        return response()->json($rspDataObj, 200);
        
    }
    
    
    public function updateProdSubCtgryDetails(Request $request){
        
        $rspDataObj = array(
            'cntOfProdSubCtgryDataUpdated'=> 0,
            'msgArr' => array("No product category with subcategory details were found")
        );
        
        try{
            
            ### extracted parameter data
            $arrLen = 0;
            $prodSubCtgryDataArrOfArr = $request->prodSubCtgryDataArrOfArr;
            if($prodSubCtgryDataArrOfArr!=false && $prodSubCtgryDataArrOfArr!=null){
                $arrLen = count($prodSubCtgryDataArrOfArr);
            }
        
            if($arrLen>0){
                
                $arrIndx = 0;
                while($arrIndx < $arrLen){
                    
                    ### extracted each subcategory product details
                    $eachProdSubCtgryDataObj = $prodSubCtgryDataArrOfArr[$arrIndx];
                    
                    $updateTblQryStmtStr = "UPDATE SUB_CATEGORY sc ";
                    $updateTblQryColsStmtStr = "";
                    $updateTblQryWhereStmtStr = "";
                    $updateQryStr = "";
                        
                        ### preparing cols query to updating purposes
                        if(array_key_exists('prodSubCtgryStatus', $eachProdSubCtgryDataObj)){
                            $updateTblQryColsStmtStr.= "sc.status = '".$eachProdSubCtgryDataObj['prodSubCtgryStatus']."',";
                        }
                        if(array_key_exists('updatedBy', $eachProdSubCtgryDataObj)){
                            $updateTblQryColsStmtStr.= "sc.updated_by = '".$eachProdSubCtgryDataObj['updatedBy']."',";
                        }
                        
                        ### where clause prepare
                        if(array_key_exists('prodSubCtgryId', $eachProdSubCtgryDataObj)){
                            $updateTblQryWhereStmtStr.= " AND sc.id IN ('".$eachProdSubCtgryDataObj['prodSubCtgryId']."')";
                        }
                        
                        if($updateTblQryColsStmtStr!="" && $updateTblQryWhereStmtStr!=""){
                            
                            $updateTblQryColsStmtStr = " SET ".trim($updateTblQryColsStmtStr, ',');
                            $updateTblQryWhereStmtStr = " WHERE 1 $updateTblQryWhereStmtStr";
                            $updateQryStr = $updateTblQryStmtStr.$updateTblQryColsStmtStr.$updateTblQryWhereStmtStr;
                                    
                        }
                        
                        if($updateQryStr!=""){
                            
                            $cntOfDataUpdated =  DB :: update($updateQryStr);
                            if($cntOfDataUpdated>0){
                                $rspDataObj['cntOfProdSubCtgryDataUpdated'] = $rspDataObj['cntOfProdSubCtgryDataUpdated'] + 1;
                            }
                            
                        }
                    
                    $arrIndx++;
                    
                }
                
                if($rspDataObj['cntOfProdSubCtgryDataUpdated'] > 0){
                    
                    $msgStr = $rspDataObj['cntOfProdSubCtgryDataUpdated'] . " subcategory details is updated successfully";
                    $rspDataObj['msgArr'] = array($msgStr);
                    
                }else{
                    
                    $rspDataObj['cntOfProdSubCtgryDataUpdated'] = 0;
                    $rspDataObj['msgArr'] = array("Invalid parameter pass to update product subcategory details");
                
                }
                
            }else{
                
                $rspDataObj['cntOfProdSubCtgryDataUpdated'] = 0;
                $rspDataObj['msgArr'] = array("No parameter pass to update product subcategory details");
            
            }
            
        }catch(Exception $ex){
            
            $rspDataObj['cntOfProdSubCtgryDataUpdated'] = 0;
            $rspDataObj['msgArr'] = array("Exception occured while updating product subcategory details");
            
        }
        
        ### returning response
        return response()->json($rspDataObj, 200);
        
    }
    
    
}
