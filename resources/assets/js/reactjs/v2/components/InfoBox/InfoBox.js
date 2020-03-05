import React, {Component} from 'react';
import ReactDom, {render} from 'react-dom';
import PropTypes from 'prop-types';

/** class InfoBox2 */
class InfoBox extends Component {
    constructor(props) {
        super(props);
        this.state = {
            ad: this.props.ad
        };
    }

/*    getImage = () => {
        return <img src={this.state.ad.image_url} />
    };*/

    getAd = () => {
        if (this.state.ad.message.length) {
            return <div dangerouslySetInnerHTML={{__html: this.state.ad.message}} />
        }
/*        if (this.state.ad.link.length) {
            return this.state.ad.image_url !== null ?
                <a href={this.state.ad.link} target="_blank">{ this.getImage() }</a> :
                <a href={this.state.ad.link} target="_blank">{ this.state.ad.body }</a>
        } else {
            return this.state.ad.image_url !== null ?
                this.getImage() :
                this.state.ad.body
        }*/
    };

    render() {
        return (

            <div className="information-box">
                <strong>
                { this.getAd() }
                </strong>
            </div>
        );
    }
}

InfoBox.propTypes = {
    /** message */
    ad: PropTypes.object.isRequired
};

InfoBox.defaultProps = {
    ad: {}
};

export default InfoBox;

// let childMessage = (<div><strong>!! Be sure to signup for a Microsite to increase your lead flow.</strong></div>);

if (document.getElementById('information-box')) {
    render(
        <InfoBox ad={superAd} />,
        document.getElementById('information-box')
    );
}