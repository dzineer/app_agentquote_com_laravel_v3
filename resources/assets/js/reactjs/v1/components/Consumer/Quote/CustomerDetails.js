import React from 'react';
import PropTypes from 'prop-types';
import {render} from "react-dom";

/** function: CustomerDetails */
const CustomerDetails = (props) => {

    checkZip = (k) => {
        return (k >= '0' && k <= '9' || k === 'Backspace');
    };

    return (
        <form>
            <h5 className="heading-info">Customer Details</h5>
            <div className="form-group">
                <div className="row">
                    <div className="col-md-6 mt-2 mb-2">
                        <input type="text" className="form-control" id="fname" name="fname"
                               placeholder="First name" />
                    </div>
                    <div className="col-md-6 mt-2 mb-2">
                        <input type="text" className="form-control" id="lname" name="lname" placeholder="Last name" />
                    </div>
                    <div className="col-md-6 mt-2 mb-2">
                        <input type="text" className="form-control" placeholder="Phone" />
                    </div>
                    <div className="col-md-6 mt-2 mb-2">
                        <input type="text" className="form-control" placeholder="Email" />
                    </div>
                    <div className="col-md-6 mt-2 mb-2">
                        <input type="text" className="form-control" placeholder="Address 1" />
                    </div>
                    <div className="col-md-6 mt-2 mb-2">
                        <input type="text" className="form-control" placeholder="Address 2" />
                    </div>
                    <div className="col-md-6 mt-2 mb-2">
                        <select id="aq2e_state" name="aq2e_state" className="form-control" defaultValue={user_default_state}>
                            <option className="aq2e-select-option" selected="selected">Select State</option>
                            <option className="aq2e-select-option" value="AK" selected="selected">Alaska</option>
                            <option className="aq2e-select-option" value="AL">Alabama</option>
                            <option className="aq2e-select-option" value="AR">Arkansas</option>
                            <option className="aq2e-select-option" value="AZ">Arizona</option>
                            <option className="aq2e-select-option" value="CA">California</option>
                            <option className="aq2e-select-option" value="CO">Colorado</option>
                            <option className="aq2e-select-option" value="CT">Connecticut</option>
                            <option className="aq2e-select-option" value="DC">Washington DC</option>
                            <option className="aq2e-select-option" value="DE">Delaware</option>
                            <option className="aq2e-select-option" value="FL">Florida</option>
                            <option className="aq2e-select-option" value="GA">Georgia</option>
                            <option className="aq2e-select-option" value="HI">Hawaii</option>
                            <option className="aq2e-select-option" value="IA">Iowa</option>
                            <option className="aq2e-select-option" value="ID">Idaho</option>
                            <option className="aq2e-select-option" value="IL">Illinois</option>
                            <option className="aq2e-select-option" value="IN">Indiana</option>
                            <option className="aq2e-select-option" value="KS">Kansas</option>
                            <option className="aq2e-select-option" value="KY">Kentucky</option>
                            <option className="aq2e-select-option" value="LA">Louisiana</option>
                            <option className="aq2e-select-option" value="MA">Massachusetts</option>
                            <option className="aq2e-select-option" value="MD">Maryland</option>
                            <option className="aq2e-select-option" value="ME">Maine</option>
                            <option className="aq2e-select-option" value="MN">Minnesota</option>
                            <option className="aq2e-select-option" value="MO">Missouri</option>
                            <option className="aq2e-select-option" value="MS">Mississippi</option>
                            <option className="aq2e-select-option" value="MT">Montana</option>
                            <option className="aq2e-select-option" value="NC">North Carolina</option>
                            <option className="aq2e-select-option" value="ND">North Dakota</option>
                            <option className="aq2e-select-option" value="NE">Nebraska</option>
                            <option className="aq2e-select-option" value="NH">New Hampshire</option>
                            <option className="aq2e-select-option" value="NJ">New Jersey</option>
                            <option className="aq2e-select-option" value="NM">New Mexico</option>
                            <option className="aq2e-select-option" value="NV">Nevada</option>
                            <option className="aq2e-select-option" value="NY">New York</option>
                            <option className="aq2e-select-option" value="OH">Ohio</option>
                            <option className="aq2e-select-option" value="OK">Oklahoma</option>
                            <option className="aq2e-select-option" value="OR">Oregon</option>
                            <option className="aq2e-select-option" value="PA">Pennsylvania</option>
                            <option className="aq2e-select-option" value="RI">Rhode Island</option>
                            <option className="aq2e-select-option" value="SC">South Carolina</option>
                            <option className="aq2e-select-option" value="SD">South Dakota</option>
                            <option className="aq2e-select-option" value="TN">Tennessee</option>
                            <option className="aq2e-select-option" value="TX">Texas</option>
                            <option className="aq2e-select-option" value="UT">Utah</option>
                            <option className="aq2e-select-option" value="VA">Virginia</option>
                            <option className="aq2e-select-option" value="VT">Vermont</option>
                            <option className="aq2e-select-option" value="WA">Washington</option>
                            <option className="aq2e-select-option" value="WI">Wisconsin</option>
                            <option className="aq2e-select-option" value="WV">West Virginia</option>
                            <option className="aq2e-select-option" value="WY">Wyoming</option>
                        </select>
                    </div>
                    <div className="col-md-6 mt-2 mb-2">
                        <input type="text" className="form-control" placeholder="Zip Code" onKeyDown="return checkZip(event.key)" />
                    </div>
                </div>
            </div>

            <div className="form-group">
                <div className="row">
                    <div className="col-md-6 mt-2 mb-2">
                        <div className="form-check">
                            <input className="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                            <label className="form-check-label" htmlFor="defaultCheck1">
                                Save Customer Details
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    );
};

CustomerDetails.propTypes = {
    /** myProp */
    //myProp: PropTypes.string.isRequired
};

CustomerDetails.defaultProps = {
    //myProp: val
};

export default CustomerDetails;

if (document.getElementById('customer-details')) {
    render(<CustomerDetails />,
        document.getElementById('customer-details')
    );
}