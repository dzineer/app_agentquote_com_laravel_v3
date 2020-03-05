import React, {Component} from 'react';
import PropTypes from 'prop-types';

class LoadingDots extends Component {
    constructor(props) {
        super(props);
        this.state = {frame: 1};
    }

    componentDidMount() {
        this.interval = setInterval(() => {
            this.setState({ // eslint-disable-line react/no-did-mount-set-state
                frame: this.state.frame + 1
            })
        }, this.props.interval);
    }

    componentWillUnmount() {
        clearInterval(this.interval);
    }

    render() {
        let dots = this.state.frame % ( this.props.dots + 1 );
        let text = '';
        while(dots > 0) {
            text += '.';
            dots--;
        }
        return (
            <span {...this.props}>{text}&nbsp;</span>
        );
    }
}

LoadingDots.propTypes = {
    /** required interval */
    interval: PropTypes.number.isRequired,

    /** required number of dots */
    dots: PropTypes.number.isRequired
};

LoadingDots.defaultProps = {
    interval: 300,
    dots: 3
};

export default LoadingDots;
