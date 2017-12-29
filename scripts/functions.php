<?php

function categories($bigware_item, $items_to_categories, $categories, $categories_description) {
    $cat_ids = array_map(function ($mapping) {
        return $mapping['categories_id'];
    }, array_filter($items_to_categories, function($entry) use ($bigware_item) {
        return $entry['items_id'] === $bigware_item['items_id'];
    }));

    $cats = array_filter($categories, function ($cat) use ($cat_ids) {
        return in_array($cat['categories_id'], $cat_ids);
    });

    $paths = array_map(function ($cat) use ($categories, $categories_description) {
        return 'Default Category/' . categoryPath($cat, $categories, $categories_description);
    }, $cats);

    return join(',', $paths);
}

function categoryPath($category, $categories, $categories_description) {
    $desc = array_shift(
        array_filter($categories_description, function($d) use ($category) {
            return $d['categories_id'] === $category['categories_id'] && $d['language_id'] === '5';
        })
    );

    if ($category['parent_id'] === '0') {
        return $desc['categories_name'];
    }

    $parentCat = array_shift(
        array_filter($categories, function ($cat) use ($category) {
            return $cat['categories_id'] === $category['parent_id'];
        })
    );

    return categoryPath($parentCat, $categories, $categories_description) . '/' . $desc['categories_name'];
}

function itemDescription($item, $items_descriptions) {
    return array_shift(
        array_filter($items_descriptions, function($d) use ($item) {
            return $d['items_id'] === $item['items_id'] && $d['language_id'] === '5';
        })
    );
}

function itemOptions($item, $items_characteristics, $items_options, $items_options_values) {
    $characteristics = array_filter($items_characteristics, function ($c) use ($item) {
        return $item['items_id'] === $c['items_id'];
    });

    $options = [];
    foreach ($characteristics as $c) {
        $options[$c['options_id']][] = $c;
    }

    $options_strings = [];
    foreach ($options as $o_id => $o) {
        $option = array_shift(array_filter($items_options, function ($io) use ($o_id) {
            return $io['items_options_id'] == $o_id && $io['language_id'] === '5';
        }));

        foreach ($o as $option_value) {
            $s = "name={$option['items_options_name']}";
            $s .= ',type=drop_down,required=1,price_type=fixed,sku=';

            $value = array_shift(array_filter($items_options_values, function ($v) use ($option_value) {
                return $v['items_options_values_id'] === $option_value['options_values_id'] && $v['language_id'] === '5';
            }));

            $s .= ",option_title={$value['items_options_values_name']}";

            $plus_minus = $option_value['price_prefix'] == '-' ? -1 : 1;
            $option_price = $plus_minus * $option_value['options_values_price'];
            $s .= ",price={$option_price}";

            $options_strings[] = $s;
        }
    }

    return join('|', $options_strings);
}


// name=Custom Yoga Option,type=drop_down,required=0,price=10.0000,price_type=fixed,sku=,option_title=Gold|name=Custom Yoga Option,type=drop_down,required=0,price=10.0000,price_type=fixed,sku=,option_title=Silver|name=Custom Yoga Option,type=drop_down,required=0,price=10.0000,price_type=fixed,sku=yoga3sku,option_title=Platinum


// type=drop_down,required=1,price_type=fixed,sku=,name=Size,option_title=XL,price=861.1111|type=drop_down,required=1,price_type=fixed,sku=,name=Size,option_title=L,price=861.1111|type=drop_down,required=1,price_type=fixed,sku=,name=Size,option_title=M,price=861.1111

