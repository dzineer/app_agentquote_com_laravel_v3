import React, {Component} from 'react';
import PropTypes from 'prop-types';

/** class Frame */
class FD3Frame extends Component {
    constructor(props) {
        super(props);
        this.state = {};
        this.tolerance = 20;
        this.iframeReady = false;
    }

    render() {
        return (
            <iframe id={this.props.target} src={this.props.src} frameBorder={0} />
        );
    }
}

FD3Frame.propTypes = {
    target: PropTypes.string.isRequired,
    src: PropTypes.string.isRequired
};

FD3Frame.defaultProps = {
    target: '',
    src: ''
};

export default FD3Frame;