import React, {Component} from 'react';
import PropTypes from 'prop-types';
import utils from '../../utils/percentUtils';

class ProgressBar extends Component {
    constructor(props) {
        super(props);
        this.state = {};
        this.colors = {
            percent: {
                range: {
                  start: this.props.start,
                  mid: this.props.mid,
                  complete: this.props.complete
                }
            }
        }
    }

    getColor = (percent) => {
        if (percent === 100) return this.colors.percent.range.complete;
        return percent < 50 ? this.colors.percent.range.start : this.colors.percent.range.mid;
    };

    getProps = () => {
        return this.props;
    };

    getWidthAsPercentage = utils.getWidthAsPercentage;

    render() {
        const {percent, width, height, shape} = this.props;
        const css = {
            of: {
                container: {
                    width: width,
                    padding: '30px 0'
                },
                bar: {
                    width: utils.getWidthAsPercentage(this.props.percent, width),
                    height: height,
                    backgroundColor: this.getColor(percent),
                    borderRadius: shape === 'circle' ? '50%' : '0'

                }
            }
        };

        return (
            <div style={css.of.container}>
                <div style={css.of.bar} />
            </div>
        );
    }
}

ProgressBar.propTypes = {
    /** Percent of progress completed */
    percent: PropTypes.number.isRequired,

    /** Bar width */
    width: PropTypes.number.isRequired,

    /** Bar height */
    height: PropTypes.number,

    /** Bar shape */
    shape: PropTypes.string,

    /** Bar color at 0 to 50% */
    start: PropTypes.string,

    /** Bar color at 50 to 99% */
    mid: PropTypes.string,

    /** Bar color at 100% */
    complete: PropTypes.string
};

ProgressBar.defaultProps = {
    shape: 'rectangle',
    height: 8,
    start: 'red',
    mid: 'lightgreen',
    complete: 'green'
};

export default ProgressBar;
 