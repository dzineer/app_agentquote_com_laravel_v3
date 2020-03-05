import React, {Component} from 'react';
import PropTypes from 'prop-types';

/** class TermlifeCarriers */
class TermlifeCarriers extends Component {
    constructor(props) {
        super(props);
        this.state = {};
    }

    render() {

        let carriersList = (
            this.props.carriers.map( carrier => {
                return (
                    <div className="col-md-12">
                        <div className="form-check">

                            <label className="form-check-label">
                                <input className="form-check-input carriers" type="checkbox" id={"carrier_" + carrier.company_id}
                                       name={"carrier_" + carrier.company_id} value={carrier.company_id}
                                       data-checked={carrier.selected}
                                       checked={ carrier.selected === 1 ? 'checked' : '' }
                                       data-products={"carrier_products_"+carrier.company_id} />
                                <input type="hidden" name={"hidden_carrier_" + carrier.company_id} value={carrier.company_id} />
                                {carrier.name}
                            </label>

                        </div>
                    </div>
                )
            })
        );

        return (
            <div>
                <h4>Choose Your Carriers</h4>
                <div className="row">
                    <div className="col-md-12">
                        <div className="form-check">
                            <label className="form-check-label">
                                <input className="form-check-input checkall-carriers" type="checkbox"
                                       id="carrier-check-all" checked="checked" />
                                <span id="select-all-label">Deselect All Carriers</span>
                            </label>
                        </div>

                    </div>
                </div>

                { carriersList }

                <div className="col-md-12">
                    <input type="submit" className="btn btn-primary btn-lg btn-block btn-huge control update-btn mt-3" value=" Save " />
                </div>

            </div>
        );
    }
}

TermlifeCarriers.propTypes = {
    /** myProp */
    carriers: PropTypes.array.isRequired
};

TermlifeCarriers.defaultProps = {
    carriers: []
};

export default TermlifeCarriers;