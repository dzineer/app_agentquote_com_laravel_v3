import React from 'react';
import PropTypes from 'prop-types';

/** function: BSPanel */
const BSPanel = (props) => {
    return (
        <div className="card mb-4">
            <div className="card-body">
                { props.children }
            </div>
        </div>
    );
}

BSPanel.propTypes = {
    /** myProp */
    //myProp: PropTypes.string.isRequired
};

BSPanel.defaultProps = {
    //myProp: val
};

export default BSPanel;