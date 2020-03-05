import React, {Component} from 'react';
import PropTypes from 'prop-types';
import zxcvbn from 'zxcvbn';
import MessagePoint from "../MessagePoint/MessagePoint";

/** class Password */
class PasswordProgressBar extends Component {
    constructor(props) {
        super(props);
        this.colors = [
            '#ff2c00',
            '#ff8800',
            '#ffb300',
            '#0284b3',
            '#00af4c'
        ];
        this.quality = [
            'Bad',
            'Week',
            'Good',
            'Strong',
            'Very strong'
        ];

        this.state = {
            password: '',
            field_type: 'password',
            progress_hint: {},
            progress: {
                quality: this.quality[0],
                hint: "Use at least 9 characters. Don't use the passwords from another sites, or anything too obvious like your pet's name.",
                show: false,
                text: 'Bad',
                value: '',
                field_id: '',
                name: 'progress-bar',
                strength: '20',
                color: this.colors[0]
            }
        };
    }

    _onFocus = (e) => {
        debugger;
        let newProgress = Object.assign({}, this.state.progress);
        newProgress.show = true;
        this.setState({
            progress: newProgress
        });
    };

    _onBlur = (e) => {
        debugger;
        let newProgress = Object.assign({}, this.state.progress);
        newProgress.show = false;
        this.setState({
            progress: newProgress
        });
    };

    onPasswordChange = (event) => {
        this.setState({ password: event.target.value });
        let password = event.target.value;
        let zxcvbn_result = zxcvbn(password)
        let strength = zxcvbn_result.score;
        let strengthMeter = 20;
        let newProgress = Object.assign({}, this.state.progress);

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

        newProgress.strength = strengthMeter;
        newProgress.color = this.colors[strength];
        newProgress.show = true;
        newProgress.text = zxcvbn_result.feedback.suggestions[0];
        newProgress.quality = this.quality[strength];

        this.setState({
            progress: newProgress
        });

        this.props.onChange(event);

    };

    onViewPassword = (event) => {
        event.preventDefault();
        if (this.state.field_type === 'password') {
            this.setState({ field_type: 'text' });
        } else {
            this.setState({ field_type: 'password' });
        }
    };

    render() {
        const style = {
            height: '2px',
            backgroundColor: this.state.progress.color,
            width: this.state.progress.strength + '%',
            margin: '0'
        };

        const messageStyle = {
            "fontSize": "0.8em",
            "textAlign": "center",
            "color": "red",
            "margin": "5px 0"
        };

        const header = (<div><strong>Password strength</strong>: {this.state.progress.quality}</div>);
        const hint = (<div>
                            <div className="progress-bar-container" />
                            {this.state.progress.hint}
                    </div>);

        const input = (<div><input type={this.state.field_type} className="form-control form-control-md password-field" name="password" id="password" value={this.state.password} placeholder="" onChange={this.onPasswordChange} onFocus={this._onFocus} onBlur={this._onBlur} maxLength={45} /><span className="view-password" onClick={this.onViewPassword}><i className="fa fa-eye orange-theme pass"></i></span></div>);

        return (
            <div>
                <div className="password-container">
                    { this.state.progress.show && <MessagePoint header={header} hint={hint} /> }
                    { input }
                    <i className="fa fa-lock orange-theme"></i>
                    <div className="progress-bar-container">
                        <div className='fd3-progress-bar' style={style} />
                    </div>
                </div>
            </div>
        );
    }
}

PasswordProgressBar.propTypes = {
    name: PropTypes.string.isRequired,
    onChange: PropTypes.func.isRequired
};

PasswordProgressBar.defaultProps = {
    name: 'password',
    onChange: () => {}
};

export default PasswordProgressBar;