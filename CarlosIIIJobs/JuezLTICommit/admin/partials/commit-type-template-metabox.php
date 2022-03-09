<table>
    <tr valign="top">
        <th class="metabox_label_column">
            <label for="url_commit">Url del commit</label>
        </th>
        <td>
            <input type="text" id="url_commit" name="url_commit" value="<?php echo @get_post_meta($post->ID, 'url_commit', true); ?>" />
        </td>
    </tr>
    <tr valign="top">
        <th class="metabox_label_column">
            <label for="socio_desarrollador">Socio que lo ha desarrollado</label>
        </th>
        <td>
            <input type="text" id="socio_desarrollador" name="socio_desarrollador" value="<?php echo @get_post_meta($post->ID, 'socio_desarrollador', true); ?>" />
        </td>
    </tr>
    <tr valign="top">
        <th class="metabox_label_column">
            <label for="milestone_perteneciente">Milestone al que pertenece</label>
        </th>
        <td>
            <input type="text" id="milestone_perteneciente" name="milestone_perteneciente" value="<?php echo @get_post_meta($post->ID, 'milestone_perteneciente', true); ?>" />
        </td>
    </tr>
</table>