import React from 'react';
import PropTypes from 'prop-types';
import {render} from "react-dom";
import Subscribe from "../Subscribe/Subscribe";

/** function: SocialMediaBar */
const SocialMediaBar = (props) => {

    debugger;
    let icons = props.Icons.map( socialMedia => {
        return (
            <li>
                <a className={ "icon " +  socialMedia.icon + " icon-default" }
                   href={ socialMedia.link }
                  target="_blank"><i/>
                </a>
            </li>
        );
    });

    return (
        <ul className="list-inline list-inline-md">
            { icons }
        </ul>
    );
};

SocialMediaBar.propTypes = {
    Icons: PropTypes.array.isRequired
};

SocialMediaBar.defaultProps = {
    Icons: []
};

export default SocialMediaBar;

if (document.getElementById('social-media-bar')) {
    render(
        <SocialMediaBar Icons={ social_media_icons } />,
        document.getElementById('social-media-bar')
    )
}
