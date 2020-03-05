import React, { Component } from 'react';
import PropTypes from 'prop-types';
import Label from '../Label';
import RadioInput from '../RadioInput';
import styles from './styles';

class SwitchInput extends Component {
    constructor(props) {
        super(props);
        console.log(props);
        this.state = {
            first: {
                checked: true
            },
            second: {
                checked: false
            }
        };

    }

    onFirstChange = event => {
        let state = Object.assign({}, this.state);
        state.first.checked = true;
        state.second.checked = false;
        this.setState(state);
        this.props.onChange(event);
    };

    onSecondChange = event => {
        let state = Object.assign({}, this.state);
        state.second.checked = true;
        state.first.checked = false;
        this.setState(state);
        this.props.onChange(event);
    };

    render() {
        const {radioName, firstHtmlId, firstLabel, firstRadioClassName, firstLabelClassName, firstValue,
            secondHtmlId, secondLabel, secondRadioClassName, secondLabelClassName, secondValue } = this.props;
        const {first, second} = this.state;
    return (
        <div className="container-switch" style={styles.containerSwitch}>
                <RadioInput
                    htmlId={firstHtmlId}
                    radioName={radioName}
                    className={firstRadioClassName}
                    onChange={this.onFirstChange}
                    value={firstValue}
                    styles={styles.switchInput}
                    selected={first.checked}
                />
                <Label htmlFor={firstHtmlId} label={firstLabel} labelClassName={firstLabelClassName} styles={first.checked ? Object.assign({}, styles.switchLabelChecked, styles.switchLeft, styles.checkedRight) : Object.assign({}, styles.switchLabel, styles.switchLeft)} />
                <RadioInput
                    htmlId = {secondHtmlId}
                    radioName={radioName}
                    className={secondRadioClassName}
                    onChange={this.onSecondChange}
                    value={secondValue}
                    styles={styles.switchInput}
                    selected={second.checked}
                />
                <Label htmlFor={secondHtmlId} label={secondLabel} labelClassName={secondLabelClassName} styles={second.checked ? Object.assign({}, styles.switchLabelChecked, styles.switchLeft, styles.checkedLeft) : Object.assign({}, styles.switchLabel, styles.switchRight)} />
        </div>
    );


    }

}

SwitchInput.propTypes = {
    /** name one id */
    firstHtmlId: PropTypes.string.isRequired,

    /** group name  */
    name: PropTypes.string.isRequired,

    /** name of the first text */
    firstLabel: PropTypes.string,

    /** name of the first label class name text */
    firstRadioClassName: PropTypes.string,

    /** name of the first label class name text */
    firstLabelClassName: PropTypes.string,

    /** Value of the first switch item */
    firstValue: PropTypes.string,

    /** name one id */
    secondHtmlId: PropTypes.string.isRequired,

    /** name of the second text */
    secondLabel: PropTypes.string,

    /** name of the first label class name text */
    secondRadioClassName: PropTypes.string,

    /** name of the second label class name text */
    secondLabelClassName: PropTypes.string,

    /** Value of the second switch item */
    secondValue: PropTypes.string,

    /** default switch direction */
    defaultSwitch: PropTypes.oneOf(['first', 'second']),

    /** onChange handler */
    onChange: PropTypes.func.isRequired
};

SwitchInput.defaultProps = {
  name: '',
  firstLabel: 'Yes',
  firstValue: '1',
  secondLabel: 'No',
  secondValue: '2',
  defaultSwitch: 'one',
  firstLabelClassName: "switch-label form-control switch-right",
  secondLabelClassName: "switch-label form-control switch-left",
};

export default SwitchInput;