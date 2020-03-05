import React, { Component } from 'react';
import { findDOMNode, render } from "react-dom";
import PropTypes from 'prop-types';
import BannerContainer from "../banner/BannerContainer";

/** function: LogoScroller */
class LogoScroller extends Component {
    constructor(props) {
        super(props);

        this.logos_scroll_content = [];

        this.logos = [
            {"src":"https://banner.aq2e.com/logos/principal-financial-group.jpg"},
            {"src":"https://banner.aq2e.com/logos/protective-life-insurance.jpg"},
            {"src":"https://banner.aq2e.com/logos/pruco-life-insurance.jpg"},
            {"src":"https://banner.aq2e.com/logos/savings-bank-life-insurance-of-ma.jpg"},
            {"src":"https://banner.aq2e.com/logos/transamerica-life-insurance.jpg"},
            {"src":"https://banner.aq2e.com/logos/united-of-omaha-life-insurance.jpg"},
            {"src":"https://banner.aq2e.com/logos/american-general-life-insurance.jpg"},
            {"src":"https://banner.aq2e.com/logos/axa-equitable-life-insurance.jpg"},
            {"src":"https://banner.aq2e.com/logos/banner-life-insurance.jpg"},
            {"src":"https://banner.aq2e.com/logos/brighthouse-life-insurance-company.jpg"},
            {"src":"https://banner.aq2e.com/logos/north-american-for-life-and-health-insurance.jpg"}
        ];

        this.logosScroll = this.logos;

        this.styles = {
            for: {
                carouselWrapper: {
                    width: '100%',
                    overflow: 'hidden',
                    height: '92px',
                    padding: '11px 10px',
                    marginLeft: '0'
                },
                carousel: {
                    position: 'relative',
                    left: '0px',
                    height: '74px',
                    overflow: 'hidden',
                    container: {
                        width: ''
                    },
                    width: '',
                    image: {
                        width: '105px',
                        height: '68px'
                    },
                    gap: {
                        width: '21px'
                    },
                    /*                "textAlign": "left",
                                    "float": "none",
                                    "position": "relative",
                                    "top": "0px",
                                    "right": "auto",
                                    "bottom": "auto",
                                    "left": "-153.619px",
                                    "margin": "0px",
                                    "width": "6400px",
                                    "height": "100px",
                                    "zIndex": "auto",*/
                    ul: {
                        listStyle: 'none',
                        li: {
                            listStyle: 'none',
                            padding: '4px 10px'
                        }
                    }
                }
            }
        };

    }

    render() {

        this.logos_scroll_content = this.logosScroll.map( (logo, index) => {
            return (
                <li key={index} style={this.styles.for.carousel.li}>
                    <img alt="Image" src={logo.src} />
                </li>
            )
        }) ;

        // // debugger;

        return (
            <div id="carrier-logos">
                <ul style={this.styles.for.carousel.ul} >
                    {this.logos_scroll_content}
                </ul>
            </div>

        );
    }
}

LogoScroller.propTypes = {
    /** myProp */
    //myProp: PropTypes.string.isRequired
};

LogoScroller.defaultProps = {
    //myProp: val
};

export default LogoScroller;

if (document.getElementById('logos')) {
    render(
        <LogoScroller />,
        document.getElementById('logos')
    );
}