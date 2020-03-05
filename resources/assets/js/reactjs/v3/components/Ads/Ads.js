import React, {Component} from 'react';
import ReactDOM, { render } from 'react-dom'
import PropTypes from 'prop-types';
import Ad from "./Ad";

/** class Ads */
class Ads extends Component {
    constructor(props) {
        super(props);
        this.state = {};
    }

    render() {
        return (
            <div className="row">
                <div className="col-md-4 mb-3">
                    <Ad>
                        <h5>Ad 1</h5>
                        <p>This is a quick ad</p>
                        <a href="#" className="btn btn-primary btn-block">Sign Up</a>
                    </Ad>
                </div>
                <div className="col-md-4 mb-3">
                    <Ad>
                        <h5>Ad 2</h5>
                        <p>This is a quick ad</p>
                        <a href="#" className="btn btn-primary btn-block">Upgrade</a>
                    </Ad>
                </div>
                <div className="col-md-4 mb-3">
                    <Ad>
                        <h5>Ad 3</h5>
                        <p>This is a quick ad</p>
                        <a href="#" className="btn btn-primary btn-block">Upgrade</a>
                    </Ad>
                </div>
            </div>
        );
    }
}

Ads.propTypes = {
    /** myProp */
    //myProp: PropTypes.string.isRequired
};

Ads.defaultProps = {
    //myProp: val
};

export default Ads;

if (document.getElementById('ads')) {
    render(
        <Ads />,
        document.getElementById('ads')
    )
}