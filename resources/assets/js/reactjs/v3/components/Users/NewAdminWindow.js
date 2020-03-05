import React, {Component} from 'react';
import PropTypes from 'prop-types';

/** class NewAdminWindow */
class NewAdminWindow extends Component {
    constructor(props) {
        super(props);
        this.state = {
            new_group: ''
        };

        this.fieldChanged.bind(this);
        this.saveGroup.bind(this);
    }

    saveGroup = () => {
        this.props.onChange(this.state.new_group);
        this.setState({ new_group: ''});
    };

    fieldChanged = (e) => {
        let newState = Object.assign({}, this.state);
        newState[e.target.name] = e.target.value;
        this.setState(newState );
    };

    render() {
        return (

            <div className="new-group-window" ref="new_group_window">
                <div className="row">
                    <div className="col-md-12">

                        <div className="row">

                            <div className="col-md-12">
                                <div className="form-group">
                                    <label htmlFor="usr">Name:</label>
                                    <input type="text" className="form-control group_name" name="new_group" onChange={this.fieldChanged} />
                                </div>
                                <div className="form-group">
                                    <label htmlFor="usr">Email:</label>
                                    <input type="text" className="form-control group_name" name="new_group" onChange={this.fieldChanged} />
                                </div>
                            </div>

                            <div className="col-md-12">
                                <input type="submit"
                                       className="btn btn-primary btn-lg btn-block btn-huge control update-btn mt-3 mb-3"
                                       value=" Save " onClick={ this.saveGroup } />
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

NewAdminWindow.propTypes = {
    show: PropTypes.bool.isRequired,
    onChange: PropTypes.func.isRequired
};

NewAdminWindow.defaultProps = {
    show: false,
    onChange: () => {}
};

export default NewAdminWindow;