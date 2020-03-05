import React, {Component} from 'react';
import PropTypes from 'prop-types';
import BSPanel from "../Bootstrap/4/components/BSPanel";

/** class NewGroupPanel */
class NewGroupPanel extends Component {
    constructor(props) {
        super(props);
        this.state = {
            new_group_name: ''
        };

        this.onGroupAdd.bind(this);
        this.onCancel.bind(this);
        this.onFieldChanged.bind(this);
    }

    onGroupAdd = (e) => {
        e.preventDefault();
        this.props.onGroupAdd(this.state.new_group_name);
    };

    onCancel = (e) => {
        e.preventDefault();
        this.props.onCancel();
    };

    onFieldChanged = (e) => {

        this.setState({ [e.target.name]: e.target.value })
    };

    render() {
        return (
            this.props.show

            && <BSPanel>

                <div className="row">

                    <div className="col-md-12 my-10">

                        <div className="new-group-window" ref="add_group_window">

                            <div className="row">

                                <div className="col-md-12">

                                    <div className="row">

                                        <div className="col-md-6">
                                            <div className="form-group">
                                                <label>Group</label>
                                                <input type="text" className="form-control control-md group_name" name="new_group_name" placeholder="New group" onChange={this.onFieldChanged} />
                                            </div>
                                        </div>

                                        <div className="col-md-6">

                                            <div className="row">

                                                <div className="col-md-6">
                                                    <div className="form-group">
                                                        <label> </label>
                                                        <input type="submit"
                                                               className="btn btn-primary btn-md btn-block btn-huge control update-btn mt-2"
                                                               value=" Save " onClick={ this.onGroupAdd } />
                                                    </div>
                                                </div>

                                                <div className="col-md-6">

                                                    <div className="form-group">
                                                        <label> </label>
                                                        <input type="button"
                                                               className="btn btn-danger btn-md btn-block btn-huge control update-btn mt-2"
                                                               value=" Cancel " onClick={ this.onCancel } />
                                                    </div>
                                                </div>

                                            </div> {/* .row */}

                                        </div>{/* .col-md-6 */}

                                    </div>{/* .row */}

                                </div>{/* .col-md-12 */}

                            </div>{/* .row */}

                        </div>{/* .new-group-window */}

                    </div>{/* .col-md-12 */}

                </div>{/* .row */}

            </BSPanel>
        );
    }
}

NewGroupPanel.propTypes = {
    onGroupAdd: PropTypes.func.isRequired,
    onCancel: PropTypes.func.isRequired,
    show: PropTypes.bool.isRequired
};

NewGroupPanel.defaultProps = {
    onGroupAdd: () => {},
    onCancel: () => {},
    show: false
};

export default NewGroupPanel;