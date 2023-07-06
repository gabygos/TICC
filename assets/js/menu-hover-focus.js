/*********************************************************************
*   Menu mouse hover and "Tab" focus
*   Description: in the function you need to specify the class of the <ul>, function works with WordPress menu structure
*   Example: <ul class="your-menu"> - jQuery('.your-menu').hfNav()
*   Created by: Vlad Voytsechovsky
*   Version: 1.0.4
*********************************************************************/
(function( $ ){
    jQuery.fn.hfNav = function( options ){

        options = jQuery.extend({
            mobileSize   : false,
            dropDownAttr : false,
        }, options );

        var html         = document.documentElement;
        var w_d          = html.clientWidth;
        var this_e       = jQuery(this);
        var data_display = '';

        this_e.find('.current-menu-item').each(function(){
            if( jQuery(this).length > 0 ){
                var parents_nav = jQuery(this).parents('.menu-item-has-children');
                if( parents_nav.length > 0 ){
                    jQuery.each( parents_nav, function(){
                        jQuery(this).addClass('children-current-menu-item');
                    });
                }
            }
        });

        if( this_e.length != 0 ){

            jQuery(this).find('.sub-menu, .trigger-fh-group-box').each(function(){
                jQuery(this).attr('aria-hidden', 'true');
                jQuery(this).attr('aria-expanded', 'false');
            });

            /**********************************************************/
            var parent_li         = jQuery(this).find('li');
            var this_link         = jQuery(this).find('li>a, li>button, li>input, li .trigger-fh-group-box input, li .trigger-fh-group-box button, li .trigger-fh-group-box select, li .trigger-fh-group-box textarea, li .trigger-fh-group-box a' );
            var group_box         = '';
            var tab               = '';
                child_            = '';
                foc_out_parent_li = '';
                foc_in_parent_li  = '';
            /**********************************************************/
            var btn_open_close = jQuery('.trigger-close-open-mobile-menu');
            var btn_close      = jQuery('.trigger-close-mobile-menu');
            var mobile_menu    = jQuery('.trigger-mobile-menu-box');
            var li_has_child   = jQuery('.trigger-mobile-menu-box .menu-item-has-children');
            /**********************************************************/

            if( w_d > options.mobileSize ){

                jQuery(this).attr('data-display', 'display');

                var this_nav = jQuery(this);
                var nav_class = this_nav.selector;
                // var this_nav_obj = {
                //     parent_class_event : false,
                // };
                jQuery(this).hover(function(){
                    jQuery(this).addClass('active');
                },function(){
                    jQuery(this).removeClass('active');
                });

                /*  mous hover sart  */
                parent_li.hover(function(){
                    jQuery( this ).addClass('item-active');
                    jQuery(this).add_aria_hidden_false();
                },function(){
                    if( jQuery( this ).find('input, a, button, select, textarea').is(':focus') === false ){
                        jQuery( this ).removeClass('item-active');
                        jQuery( this ).add_aria_hidden_true();
                    }
                });
                /*  mous hover end  */


                /*  Tab focus start  */

                this_link.bind('keydown',function( e ){

                    var parent_ul   = jQuery(this).closest('ul');
                    var parent_li   = jQuery(this).closest('.menu-item');
                    var menu_length = parent_ul.children().length;

                    group_box    = jQuery(this).closest('.trigger-fh-group-box');
                    var count_el = 0;
                    if( group_box.length != 0 ){

                        var form_parent = group_box.find('form');

                        form_parent.find('input, button, select, textarea, a').not('[type="hidden"], [disabled]').each(function(){
                            count_el++;
                        });

                        if( form_parent.length != 0 ){
                            form_parent.find('input, button, select, textarea, a').not('[type="hidden"], [disabled]').first().addClass('first-group-element');
                            form_parent.find('input, button, select, textarea, a').not('[type="hidden"], [disabled]').last().addClass('last-group-element');
                        }

                        if( count_el > 1 ){
                            if( jQuery(this).hasClass('first-group-element') ){
                                child_ = 'first';
                            } else if( jQuery(this).hasClass('last-group-element') ){
                                child_ = 'last';
                            } else {
                                child_ = 'medium';
                            }
                        } else {
                            child_ = 'single';
                        }
                    } else {
                        if( menu_length > 1 ){
                            if( parent_li.is(':first-child') == true ){
                                child_ = 'first';
                            } else if(  parent_li.is(':last-child') == true ){
                                child_ = 'last';
                            } else {
                                child_ = 'medium';
                            }
                        } else {
                            child_ = 'single';
                        }
                    }

                    if( e.shiftKey &&  e.keyCode == 9 ){
                        tab = 'prev';
                    } else if( e.keyCode == 9  ){
                        tab = 'next';
                    }

                }).bind('focusout', function( e ){

                    foc_out_parent_li = jQuery(this).closest('.menu-item');

                    if( foc_out_parent_li.hasClass('menu-item-has-children') == false ){

                        if( ( tab == 'next' && child_ == 'last' ) || ( tab == 'next' && child_ == 'single' ) ){

                            foc_out_parent_li.removeClass('item-active');
                            foc_out_parent_li.add_aria_hidden_true();
                            foc_out_parent_li.parent().parent().next_close_menu();

                        } else if( tab == 'prev' && child_ == 'first' ){

                            foc_out_parent_li.removeClass('item-active');
                            foc_out_parent_li.add_aria_hidden_true();
                            foc_out_parent_li.parent().parent().prev_close_menu();

                        } else if( ( tab == 'prev' && child_ == 'last' ) || ( tab == 'prev' && child_ == 'single' ) || child_ == 'first' || child_ == 'medium' ){

                            foc_out_parent_li.removeClass('item-active');
                            foc_out_parent_li.add_aria_hidden_true();
                        }

                    } else if( foc_out_parent_li.hasClass('menu-item-has-children') == true ){

                        if( tab == 'prev' ){
                            foc_out_parent_li.removeClass('item-active');
                            foc_out_parent_li.add_aria_hidden_true();
                        }
                    }

                    foc_out_parent_li.closest( nav_class ).removeClass('active');

                }).bind('focusin', function( e ){

                    foc_in_parents = jQuery(this).parents('.menu-item');
                    foc_in_parents.each(function(){
                        if( !jQuery(this).hasClass('item-active') ){
                            jQuery(this).addClass('item-active');
                        }
                    });

                    foc_in_parent_li = jQuery(this).closest('.menu-item');

                    foc_in_parent_li.closest('.menu-item').addClass('item-active');
                    foc_in_parent_li.closest('.menu-item').add_aria_hidden_false();

                    foc_in_parent_li.closest( nav_class ).addClass('active');

                }).bind('keyup', function(){

                });
                /*  Tab focus end  */

            } else if( w_d <= options.mobileSize && options.mobileSize ){

                jQuery(this).attr('data-display', 'mobile');

                btn_open_close.on('click', function(){

                    if( mobile_menu.hasClass('open-mobile-menu') ){
                        mobile_menu.removeClass('open-mobile-menu');
                        btn_open_close.removeClass('open');
                    } else {
                        mobile_menu.addClass('open-mobile-menu');
                        btn_open_close.addClass('open');
                    }
                });

                btn_close.on('click', function(){
                    if( mobile_menu.hasClass('open-mobile-menu') ){
                        mobile_menu.removeClass('open-mobile-menu');
                    }
                });

                li_has_child.on('click', function(){
                    if( jQuery(this).find('.sub-menu').hasClass('open-sub-menu') ){
                        jQuery(this).find('.sub-menu').removeClass('open-sub-menu');
                    } else {
                        jQuery(this).find('>.sub-menu').addClass('open-sub-menu');
                    }
                });
            }
            jQuery.fn.next_close_menu = function(){
                jQuery(this).removeClass('item-active');
                jQuery(this).add_aria_hidden_true();
                if(  jQuery(this).is(':last-child') == true ){
                    jQuery(this).parent().parent().next_close_menu();
                }
            }
            jQuery.fn.prev_close_menu = function(){
                jQuery(this).removeClass('item-active');
                jQuery(this).add_aria_hidden_true();
            }
            jQuery.fn.add_aria_hidden_true = function(){
                jQuery(this).find('.sub-menu').attr('aria-hidden', 'true');
                jQuery(this).find('.sub-menu').attr('aria-expanded', 'false');
            }
            jQuery.fn.add_aria_hidden_false = function(){
                jQuery(this).find('>.sub-menu').attr('aria-hidden', 'false');
                jQuery(this).find('>.sub-menu').attr('aria-expanded', 'true');
            }

            jQuery( window ).resize(function(){

                if( options.mobileSize ){
                    w_d = html.clientWidth;

                    if( w_d > options.mobileSize ){
                        data_display = 'display';
                    } else if( w_d <= options.mobileSize && options.mobileSize ){
                        data_display = 'mobile';
                    }

                    if( typeof this_e.attr('data-display') != 'undefined' ){
                        if( data_display != this_e.attr('data-display') ){
                            parent_li.unbind('hover');
                            this_link.unbind('keydown, focusout, focusin');
                            btn_open_close.unbind('click');
                            btn_close.unbind('click');
                            li_has_child.unbind('click');
                            this_e.hfNav( options );
                        }
                    }
                }
            });
        };
    };
})( jQuery );
