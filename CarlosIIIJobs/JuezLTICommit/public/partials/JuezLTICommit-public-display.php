<?php
function JuezLTICommitWidgetPublicForm($args, $instance) {
    $title = apply_filters( 'widget_title', $instance['title'] );

    // los argumentos before y after del widget son definidos por el tema
    echo $args['before_widget'];
    if ( ! empty( $title ) )
    echo $args['before_title'] . $title . $args['after_title'];

    // Aquí es donde ejecutaremos el código y mostramos la salida
    echo __( 'Suscríbete para recibir nuestras ofertas de trabajo', 'JuezLTICommitSuscribe_widget_domain' );
    echo $args['after_widget'];
    ?>
    <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
        <input type="hidden" name="action" value="JuezLTICommit_suscribe">
        <p>
            <label for="solo-subscribe-nombre"><?php _e('Nombre:', 'subscribe-to-comments'); ?>
                <input type="nombre" name="nombre" id="solo-subscribe-nombre" size="23" value="" /></label>
            <br>
            <label for="solo-subscribe-email"><?php _e('E-Mail:', 'subscribe-to-comments'); ?>
                <input type="email" name="email" id="solo-subscribe-email" size="23" value="" /></label>
            <br>
            <label for="solo-subscribe-url_logo"><?php _e('Logotipo(url):', 'subscribe-to-comments'); ?>
                <input type="url_logo" name="url_logo" id="solo-subscribe-url_logo" size="20" value="" /></label>
            <br>
            <input type="submit" name="submit" value="<?php _e('Subscribe', 'subscribe-to-comments'); ?>" />
        </p>
    </form>
<?php
}
?>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
