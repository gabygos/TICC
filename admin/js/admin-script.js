// ADMIN scripts
const page_obj = {};
jQuery(document).ready( function(){


    theme_get_address_data();
});

function theme_get_address_data(e){

    jQuery(document).on('click', '.trigger-search-google-address', function( e ){

        e.preventDefault();

        const map_api_key = jQuery('[name="map_api_key"]').val().trim();
        const input_address = encodeURIComponent( jQuery('[name="google_map_address"]').val().trim() );

        if( map_api_key && input_address ){
            fetch("https://maps.googleapis.com/maps/api/geocode/json?address="+input_address+"&key="+map_api_key)
                .then((response) => response.json())
                .then( (data) => {
                    const { results, status } = data;
                    console.log( results );
                    if( typeof status == 'string' && status.toLowerCase() == 'ok' ){

                        let search_data = '';
                        const set_btn = '<button type="button" class="components-button is-primary trigger-google-map-set-location">set location</button>'

                        const address  = results[0].address_components;
                        const geometry = results[0].geometry;
                        const location = geometry.location;

                        // console.log( 'address', address );

                        const address_obj = address.reduce(( acc, part, i, arr ) => {

                            if( part.types[0] == 'street_number' ){
                                acc.number = part.long_name;
                            } else if ( part.types[0] == 'route' ) {
                                acc.street = part.short_name;
                            } else if ( part.types[0] == 'locality' ) {
                                acc.locality = part.long_name;
                            }
                            return acc;
                        }, {} );

                        let address_str = ''
                        if( typeof address_obj.locality != 'undefined' ){
                            address_str += address_obj.locality + ' ';
                        }
                        if( typeof address_obj.street != 'undefined' ){
                            address_str += address_obj.street + ' ';
                        }
                        if( typeof address_obj.number != 'undefined' ){
                            address_str += address_obj.number + ' ';
                        }

                        // console.log('address_str', address_str);

                        page_obj.googleMap = {
                            address : address_str,
                            lat     : location.lat,
                            lng     : location.lng,
                        };

                        search_data += '<div class="added-data address">address: '+address_str+'</div>';
                        search_data += '<div class="added-data location">lat: '+location.lat+'<br>lng: '+location.lng+'</div>';
                        search_data += '<div class="added-data set-location">'+set_btn+'</div>';

                        // console.log( 'address', address );
                        // console.log( 'geometry', geometry );

                        jQuery('.trigger-google-map-search-data').html( search_data );
                    }
                });
        }
    });

    jQuery(document).on('click', '.trigger-google-map-set-location', function( e ){

        e.preventDefault();

        jQuery('[name="google_map_address"]').val( page_obj.googleMap.address );
        jQuery('[name="google_map_lat"]').val( page_obj.googleMap.lat );
        jQuery('[name="google_map_lng"]').val( page_obj.googleMap.lng );

        jQuery('.trigger-google-map-search-data').html('');
    });
}
