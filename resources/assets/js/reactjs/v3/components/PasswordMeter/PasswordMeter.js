import React, {Component} from 'react';
import PropTypes from 'prop-types';

/** class PasswordMeter */
class PasswordMeter extends Component {
    constructor(props) {
        super(props);
        this.state = {};
    }

/*
<script>
	window.load_zxcvbn_script = function()
	{
		if ( document.getElementById( 'zxcvbn' ) ){
			window.zxcvbn_load_hook();
			return;
		}

		var fjs = document.getElementsByTagName( 'script' )[ 0 ];
		var js = document.createElement( 'script' );
		js.id = 'zxcvbn';

		js.src = window.zxcvbn_url;
		fjs.parentNode.insertBefore( js, fjs );
	};

	window.zxcvbn_load_hook = function()
	{

	if ( $( '#password-strength-meter-wrapper' )
		.length ) return;

	$( 'input[name=password]:visible' )
		.keyup( function()
		{
			var color_map = [ '', '#c81818', '#ffac1d', '#a6c060', '#27b30f' ];

			var word_map = [
				[ '#444', $( '#zxcvbn_string_very_weak' )
					.html() || 'Very weak'
				],
				[ '#c81818', $( '#zxcvbn_string_weak' )
					.html() || 'Weak'
				],
				[ '#e28f00', $( '#zxcvbn_string_so_so' )
					.html() || 'So-so'
				],
				[ '#8aa050', $( '#zxcvbn_string_good' )
					.html() || 'Good'
				],
				[ '#27b30f', $( '#zxcvbn_string_great' )
					.html() || 'Great'
				],
			];

			var pass = $( this )
				.val();
			if ( !pass || !pass.length )
			{
				$( '#password-strength-meter' )
					.css(
					{
						width: '0px'
					} );
				$( '#password-strength-label' )
					.html( '&nbsp;' );
				return;
			}

			var fields = [ 'username', 'email', 'url', 'name' ];
			var ins = [];

			for ( var i = 0; i < fields.length; i += 1 )
			{
				var str = $( 'input[name=' + fields[ i ] + ']' )
					.val();
				if ( str && str.length ) ins.push( str );
			}

			var ret = zxcvbn( pass, ins );

			var color_score;
			if ( pass.length < 6 || ret.score !== 0 )
			{
				color_score = ret.score;
			}
			else if ( ret.score === 0 )
			{
				color_score = 1;
			}

			$( '#password-strength-meter' ).css({
			    width: color_score * 25 + '%',
				'background-color': color_map[ color_score ],
			});

			$( '#password-strength-label' )
				.css({
				    color: word_map[ color_score ][ 0 ],
				}).text( word_map[ ret.score ][ 1 ] );

		} ).change( function(){
			$( this ).keyup();
		} );


	var d = $( '<div/>' );
	d.attr( 'id', 'password-strength-meter-wrapper' );

	d.css({
		position: 'relative',
		width: $( 'input[name=password]:visible' )
			.outerWidth() + 'px',
		margin: '5px 0 1rem 0',
	});
	if ( window.TS ) d.css( 'width', '100%' );
	$( 'input[name=password]:visible' ).after( d );

	var bg = $( '<div/>' );
	bg.css({
		height: '4px',
		'background-color': '#e8e8e8',
		width: '100%',
		position: 'absolute',
		left: '0',
	});
	d.append( bg );


	var color = $( '<div/>' );
	color.css({
		height: '4px',
		'background-color': '#c81818',
		width: '0',
		position: 'absolute',
		left: '0',
	});
	color.attr( 'id', 'password-strength-meter' );
	d.append( color );

	for ( var i = 1; i < 4; i += 1 )
	{
		var sep = $( '<div/>' );
		sep.css({
			height: '4px',
			width: '2px',
			'background-color': '#fff',
			position: 'absolute',
			left: i * 25 + '%',
		});
		d.append( sep );
	}

	var lbl = $( '<div/>' );
	lbl.css({
		float: 'right',
		'margin-top': '6px',
		'line-height': '16px',
		'font-size': '11px',
	});
	lbl.attr( 'id', 'password-strength-label' );
	d.append( lbl );

	$( 'input[name=password]:visible' )
		.keyup();
	};
	} )();
</script>

<div style="display:none;">
	<span id="zxcvbn_string_very_weak">Very weak</span>
	<span id="zxcvbn_string_weak">Weak</span>
	<span id="zxcvbn_string_so_so">So-so</span>
	<span id="zxcvbn_string_good">Good</span>
	<span id="zxcvbn_string_great">Great</span>
</div>

<script>
    $(window).load(load_zxcvbn_script);
    window.zxcvbn_url = "https:\/\/a.slack-edge.com\/bv1-4\/zxcvbn.78382dc41470fc4fbb28.min.js";
</script>
     */

    render() {
        const styles = {
            markers: {
                marker1: {
                    "height": "4px",
                    "width": "2px",
                    "backgroundColor": "rgb(255, 255, 255)",
                    "position": "absolute",
                    "left": "25%"
                },
                marker2: {
                    "height": "4px",
                    "width": "2px",
                    "backgroundColor": "rgb(255, 255, 255)",
                    "position": "absolute",
                    "left": "50%"
                },
                marker3: {
                    "height": "4px",
                    "width": "2px",
                    "backgroundColor": "rgb(255, 255, 255)",
                    "position": "absolute",
                    "left": "75%"
                },
                marker4: {
                    "height": "4px",
                    "backgroundColor": "rgb(232, 232, 232)",
                    "width": "100%",
                    "position": "absolute",
                    "left": "0px"
                }
            },
            passwordStrengthMeterWrapper: {
                "position": "relative",
                "width": "100%",
                "margin": "5px 0px 1rem"
            },
            passwordStrengthMeter: {
                "height": "4px",
                "width": "100%",
                "position": "absolute",
                "left": "0px",
                "backgroundColor": "rgb(39, 179, 15)"
            },
            passwordStrengthMeterLabel: {
                "float": "right",
                "marginTop": "6px",
                "lineHeight": "16px",
                "fontSize": "11px",
                "color": "rgb(39, 179, 15)"
            }
        };

        return (
            <div id="password-strength-meter-wrapper" style={styles.passwordStrengthMeterWrapper}>
                <div style={styles.markers.marker4} />
                <div id="password-strength-meter" style={styles.passwordStrengthMeter} />
                <div style={styles.markers.marker1} />
                <div style={styles.markers.marker2} />
                <div style={styles.markers.marker3} />
                <div id="password-strength-label" style={styles.passwordStrengthMeterLabel}>
                    Great
                </div>
            </div>
        );
    }
}

PasswordMeter.propTypes = {
    /** myProp */
    //myProp: PropTypes.string.isRequired
};

PasswordMeter.defaultProps = {
    //myProp: val
};

export default PasswordMeter;