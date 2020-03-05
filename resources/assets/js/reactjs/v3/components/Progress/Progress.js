import React, {Component} from 'react';
import PropTypes from 'prop-types';

/** class Progress */
class Progress extends Component {
    constructor(props) {
        super(props);
        this.colors = [
            '#ff2c00',
            '#ff8800',
            '#ffb300',
            '#0284b3',
            '#00af4c'
        ];
        this.state = {
            value: '',
            field_id: '',
            name: 'progress-bar',
            strength: '20%',
            color: this.colors[0]
        };
    }

    componentDidMount() {
        this.setState({
            field_id: this.props.field_id,
            name: this.props.name,
            value: this.props.value
        })
    }
    static getDerivedStateFromProps(nextProps, prevState) {
        return {
            value: nextProps.value
        }
    }

    onPasswordChange = (event) => {
        debugger;
        let password = this.state.value;
        let strength = 0;
        let strengthMeter = 20;

        if (password.match(/[a-zA-Z0-9][a-zA-Z0-9]+/)) {
            strength += 1;
        }
        if (password.match(/[~<>?]+/)) {
            strength += 1;
        }
        if (password.match(/[!@$%^&*()]+/)) {
            strength += 1;
        }
        if (strength > 5) {
            strength += 1;
        }
        switch (strength) {
            case 0:
                strengthMeter = 20;
                break;
            case 1:
                strengthMeter = 40;
                break;
            case 2:
                strengthMeter = 60;
                break;
            case 3:
                strengthMeter = 80;
                break;
            case 4:
                strengthMeter = 100;
                break;

            default:
        }
        this.setState({
            strength: strengthMeter,
            color: this.colors[strength]
        });

    };

    render() {
        const style = {
            height: '2px',
            backgroundColor: this.state.color,
            width: this.state.strength
        };

        return (
            <div className={this.state.name} style={style}>
                <input type="text" name="hidden_password" value={this.state.value} />
            </div>
        );
    }
}

Progress.propTypes = {
    /** name */
    name: PropTypes.string,
    field_id: PropTypes.string.isRequired,
    value: PropTypes.string.isRequired,
};

Progress.defaultProps = {
    name: 'progress-bar',
    field_id: '',
};

export default Progress;