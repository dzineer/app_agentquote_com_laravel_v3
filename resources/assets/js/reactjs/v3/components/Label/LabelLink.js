import React from 'react';
import PropTypes from 'prop-types';

/** LabelLink with required field display, htmlFor, and block styling */
const LabelLink = ({htmlFor, label, link, className, styles, children, required}) => {
    const css = {
        for: {
            label: {
              display: 'block'
            },
            link: {
                textDecoration: 'none'
            },
            icon: {
                fontSize: "1.2rem",
                color: "rgb(221, 75, 57)"
            },
            required: {
                color: 'red'
            }
        }
    };
    console.log("[LabelLink]", className);
    return (
        <label htmlFor={htmlFor} style={styles} className={className}>
            <a href={link} target="_blank" style={css.for.link}>
            {children}
            {label} { required && <span style={css.for.required}> *</span> }
            <i className="fa fa-link" style={css.for.icon}></i>
            </a>
        </label>
    );
};

LabelLink.propTypes = {
    /** HTML ID for associated input */
    htmlFor: PropTypes.string.isRequired,

    /** Label text */
    label: PropTypes.string.isRequired,

    /** Label text */
    link: PropTypes.string.isRequired,

    /** Label Classname for CSS */
    className: PropTypes.string,

    /** Styles for CSS */
    styles: PropTypes.object,

    /** Child elements */
    children: PropTypes.object,

    /** Display asterisk after label if true */
    required: PropTypes.bool
};

LabelLink.defautTypes = {
    required: false,
    styles: {}
};

export default LabelLink;
