import React from 'react';
import PropTypes from 'prop-types';

const Item = ({htmlId, className, styles, child, ...props}) => {
    return (
        <li id={htmlId} className={className} style={styles}>{child}</li>
    );
};

Item.protoTypes = {
    /** htmlId */
    htmlId: PropTypes.string,

    /** List Item is really a container for text or other children */
    child: PropTypes.array,

    /** ClassName */
    className: PropTypes.string,

    /** Inline Styles */
    styles: PropTypes.object
};

Item.defaultProps = {
    htmlId: '',
    child: []
};

export default Item;