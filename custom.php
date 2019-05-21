<?php 
function get_tags_by_collection($collectionId)
{
    $db = get_db();
    $tagTable = $db->getTable('Tag');
    $itemTable = $db->getTable('Item');
    $select = $tagTable->getSelectForFindBy(array('type' => 'Item'));
    $itemTable->filterByCollection($select, $collectionId);
    $tags = $tagTable->fetchObjects($select);
    return $tags;
}

function contextual_public_nav_items(array $navArray = null, $maxDepth = 0)
{
    if (!$navArray) {
        $navArray = array(
            array(
                'label' =>__('Browse All'),
                'uri' => url('items/browse'),
            ));
            if (total_records('Tag')) {
                if (isset($_GET['collection'])) {
                    $collectionId = $_GET['collection'];
                    $queryParams = array('collection' => $collectionId);
                } else {
                    $queryParams = array();
                }
                $navArray[] = array(
                    'label' => __('Browse by Tag'),
                    'uri' => url('items/tags', $queryParams),
                );
            }
            $navArray[] = array(
                'label' => __('Search Items'),
                'uri' => url('items/search')
            );
    }
    return nav($navArray, 'public_navigation_items');
}

?>
