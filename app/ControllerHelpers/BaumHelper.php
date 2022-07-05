<?php
namespace App\ControllerHelpers;

use App\Models\Category;

class BaumHelper
{
    public static function renderNodeCategory($node) {
 
        $trashurl = route('categories.delete',$node->id);

        $fullchild = [];
        $fullanchor = route('categories.edit', $node->id );

        $fulltext = $node->name .'&nbsp(ID: <strong>'.$node->id.'</strong>)'. '&nbsp;<span data-link='.$trashurl.'></span>';
        // $fulltext =  '<a href='.$fullanchor.'>'.$node->name .'</a>&nbsp(ID: <strong>'.$node->id.'</strong>)'. '&nbsp;<span data-link='.$trashurl.'></span>';
        $fullid = $node->id;
        $fullparentid = $node->parent_id;

        $fullicon = 'fa '.$node->icon.' icon-state-warning icon-lg';


        if ( $node->children()->count() > 0 ) {
            foreach($node->children as $child){
                $fullchild[] = self::renderNodeCategory($child);
            }
        }
        if(count($fullchild)>0) {
            // return $mainArray = ['text'=>$fulltext , 'id'=> $fullid ,"parent_id"=> $fullparentid,'children'=>$fullchild, 'icon'=>$fullicon];
            return $mainArray = ['text'=>$fulltext , 'id'=> $fullid ,"parent_id"=> $fullparentid,'children'=>$fullchild, 'icon'=>$fullicon, 'a_attr'=>["href" => $fullanchor ]];
        }else{
            return $mainArray = ['text'=>$fulltext, 'id'=> $fullid  ,"parent_id"=> $fullparentid, 'icon'=>'la la-file','a_attr'=>["href" => $fullanchor ]];
        }

    }

    public static function renderNodeCategoryProduct($node) {

        $trashurl = route('categories.deleteone',$node->id);

        $fullchild = [];

        $fulltext = $node->name . '&nbsp;&nbsp;&nbsp;&nbsp;<span data-link='.$trashurl.'></span>';


        $fullid = $node->id;
        $fullparentid = $node->parent_id;

        $fullicon = 'fa '.$node->icon.' icon-state-warning icon-lg';
        $fullanchor = route('categories.edit', $node->id );

        if ( $node->children()->count() > 0 ) {
            foreach($node->children as $child){
                $fullchild[] = self::renderNodeCategoryProduct($child);
            }
        }
        if(count($fullchild)>0) {
            return $mainArray = ['text'=>$fulltext , 'id'=> $fullid ,"parent_id"=> $fullparentid,'children'=>$fullchild, 'icon'=>$fullicon, 'a_attr'=>["href" => $fullanchor ]];
        }else{
            return $mainArray = ['text'=>$fulltext, 'id'=> $fullid  ,"parent_id"=> $fullparentid, 'icon'=>'la la-file', 'a_attr'=>["href" => $fullanchor ]];
        }

    }

    public static function renderNode($node) {

        // return $node;
        $fullchild = [];
        $fulltext = $node->name;
        $fullid = $node->id;
        $fullparentid = $node->parent_id;
        $fullslug = $node->slug;
        $fullicon = $node->icon;

        if ( $node->children()->count() > 0 ) {
            foreach($node->children as $child){

                $fullchild[] = self::renderNode($child);

            }
        }

        if(count($fullchild)>0) {
            return $mainArray = ['text'=>$fulltext ,'slug'=>$fullslug , 'id'=> $fullid ,"parent_id"=> $fullparentid,"icon"=>$fullicon,'children'=>$fullchild];
        }else{
            return $mainArray = ['text'=>$fulltext,'slug'=>$fullslug, 'id'=> $fullid  ,"parent_id"=> $fullparentid,"icon"=>$fullicon];
        }

    }

    public static function renderSelectedNode($node, $selectedNodes) {
        // dd($selectedNodes);
        $fullchild = [];
        $fulltext = $node->name;
        $fullid = $node->id;
        $fullparentid = $node->parent_id;
        $fullslug = $node->slug;
        $fullicon = $node->icon;

        if ( $node->children()->count() > 0 ) {
            foreach($node->children as $child){
                $fullchild[] = self::renderSelectedNode($child, $selectedNodes);
            }
        }
        else
        {
            foreach($selectedNodes as $selectedNode){
                if($node->id == $selectedNode['category_id']){
                    return $mainArray = ['text'=>$fulltext,'slug'=>$fullslug, 'id'=> $fullid  ,"parent_id"=> $fullparentid,"icon"=>$fullicon, 'state' => ['selected'=>true]];
                }

                if($node->id == $selectedNode['amenities_category_id']){
                    return $mainArray = ['text'=>$fulltext,'slug'=>$fullslug, 'id'=> $fullid  ,"parent_id"=> $fullparentid,"icon"=>$fullicon, 'state' => ['selected'=>true]];
                }
            }
            return $mainArray = ['text'=>$fulltext,'slug'=>$fullslug, 'id'=> $fullid  ,"parent_id"=> $fullparentid,"icon"=>$fullicon];
        }

        if(count($fullchild)>0) {
            return $mainArray = ['text'=>$fulltext ,'slug'=>$fullslug , 'id'=> $fullid ,"parent_id"=> $fullparentid,"icon"=>$fullicon,'children'=>$fullchild];
        }
        else{
            return $mainArray = ['text'=>$fulltext,'slug'=>$fullslug, 'id'=> $fullid  ,"parent_id"=> $fullparentid,"icon"=>$fullicon];
        }

    }

    public static function renderSingleSelectedNode($node, $selectedNodes) {

        $fullchild = [];
        $fulltext = $node->name;
        $fullid = $node->id;
        $fullparentid = $node->parent_id;
        $fullslug = $node->slug;

        if ( $node->children()->count() > 0 ) {
            foreach($node->children as $child){
                $fullchild[] = self::renderSingleSelectedNode($child, $selectedNodes);
            }
        }
        else
        {
            foreach($selectedNodes as $selectedNode){
                if($node->id == $selectedNode['category_id']){
                    return $mainArray = ['text'=>$fulltext,'slug'=>$fullslug, 'id'=> $fullid  ,"parent_id"=> $fullparentid, 'state' => ['selected'=>true]];
                }
            }
            return $mainArray = ['text'=>$fulltext,'slug'=>$fullslug, 'id'=> $fullid  ,"parent_id"=> $fullparentid];
        }

        if(count($fullchild)>0) {
            return $mainArray = ['text'=>$fulltext ,'slug'=>$fullslug , 'id'=> $fullid ,"parent_id"=> $fullparentid,'children'=>$fullchild];
        }
        else{
            return $mainArray = ['text'=>$fulltext,'slug'=>$fullslug, 'id'=> $fullid  ,"parent_id"=> $fullparentid];
        }

    }

    public static function regionsWithDescendents() {
        $parent_regions = Region::roots()->get();
        $regions_data=[];
        foreach($parent_regions as $region){
            $regions_data[] = $region->getDescendantsAndSelf()->toHierarchy();
        }
        return $regions_data;
    }

    public static function categoryWithDescendents() {
        $categiry_parent = Category::roots()->orderBy('created_at','ASC')->get();
        $category_data=[];
        foreach($categiry_parent as $category){
            $category_data[] = $category->getDescendantsAndSelf()->toHierarchy();
        }
        return $category_data;
    }
}
