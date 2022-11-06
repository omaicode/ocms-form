<?php
if (!function_exists('prepare_options')) {

    /**
     * @param array $options
     *
     * @return array
     */
    function prepare_options(array $options)
    {
        $original = [];
        $toReplace = [];

        foreach ($options as $key => &$value) {
            if (is_array($value)) {
                $subArray = prepare_options($value);
                $value = $subArray['options'];
                $original = array_merge($original, $subArray['original']);
                $toReplace = array_merge($toReplace, $subArray['toReplace']);
            } elseif (strpos($value, 'function(') === 0) {
                $original[] = $value;
                $value = "%{$key}%";
                $toReplace[] = "\"{$value}\"";
            }
        }

        return compact('original', 'toReplace', 'options');
    }
}

if (!function_exists('json_encode_options')) {
    /**
     * @param array $options
     *
     * @return string
     *
     * @see http://web.archive.org/web/20080828165256/http://solutoire.com/2008/06/12/sending-javascript-functions-over-json/
     */
    function json_encode_options(array $options)
    {
        $data = prepare_options($options);

        $json = json_encode($data['options']);

        return str_replace($data['toReplace'], $data['original'], $json);
    }
}