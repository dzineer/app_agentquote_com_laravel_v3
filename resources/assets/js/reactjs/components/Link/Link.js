import React from 'react';
import PropTypes from 'prop-types';

const Link = ({path, htmlId, className, styles, child, ...props}) => {
    return (
        <a href={path} id={htmlId} className={className} style={styles}>{child}</a>
    );
};

Link.protoTypes = {
    /** Link object for Link tag */
    path: PropTypes.string.isRequired,

    /** Text for Link tag */
    child: PropTypes.object.isRequired,

    /** Class name Link tag */
    className: PropTypes.string,

    /** Styles for Link tag */
    styles: PropTypes.object
};

Link.defaultProto = {
    path: '#',
    child: 'test text'
};

export default Link;