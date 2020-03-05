import React, {Component} from 'react';
import PropTypes from 'prop-types';

/** class NewManagerPanel */
class NewManagerPanel extends Component {
    constructor(props) {
        super(props);
        this.state = {
            fname: '',
            lname: '',
            email: '',
            disable_invite: true,
        };
        this.onCancel.bind(this);
        this.fieldChanged.bind(this);
        this.invite.bind(this);
    }

    fieldChanged = (e) => {
        let newState = Object.assign({}, this.state);

        if (this.validator()) {
            newState.disable_invite = false;
        }

        newState[e.target.name] = e.target.value;
        this.setState( newState );
    };

    invite = (e) => {
      e.preventDefault();
      this.props.onNewAdmin({
          fname: this.state.fname,
          lname: this.state.lname,
          email: this.state.email
      });
    };

    onCancel = (e) => {
        e.preventDefault();
        this.props.onCancel();
    };

    validator = () => {
        return this.state.fname.length > 0 && this.state.lname.length > 0 && this.state.email.length > 5;
    };

    render() {
        return (
            this.props.show &&

            <div className="col-md-12 my-20">

                <div className="row">

                    <div className="col-md-12 my-2">
                        <h4>New Manager</h4>
                    </div>

                    <div className="col-md-3 mb-2">
                        <input type="text" className="form-control" name="fname" placeholder="First name" onChange={this.fieldChanged} required />
                    </div>

                    <div className="col-md-3 mb-2">
                        <input type="text" className="form-control" name="lname" placeholder="Last name" onChange={this.fieldChanged} required />
                    </div>

                    <div className="col-md-3 mb-2">
                        <input type="email" className="form-control" name="email" placeholder="Email" onChange={this.fieldChanged} required />
                    </div>

                    <div className="col-md-3 mb-2">

                        <div className="row">

                            <div className="col-md-6 mb-2">
                                <button className="btn btn-md btn-primary btn-block" disabled={this.state.disable_invite} onClick={this.invite}>Invite</button>
                            </div>

                            <div className="col-md-6 mb-2">
                                <button className="btn btn-md btn-danger btn-block" onClick={this.onCancel}>Cancel</button>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        );
    }
}

NewManagerPanel.propTypes = {
    show: PropTypes.bool.isRequired,
    onCancel: PropTypes.func.isRequired,
    onNewAdmin: PropTypes.func.isRequired
};

NewManagerPanel.defaultProps = {
    show: false,
    onCancel: () => {},
    onNewAdmin: () => {}
};

export default NewManagerPanel;