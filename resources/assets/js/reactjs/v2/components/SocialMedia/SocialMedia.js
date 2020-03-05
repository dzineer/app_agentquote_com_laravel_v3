import React from 'react';
import PropTypes from 'prop-types';
import Icon from "../Icon";

/** function: SocialMedia */
const SocialMedia = ({ twitter, facebook, google_plus, linkedIn }) => {

    const styles = {
        for: {
            socialMediaContainer: {
                marginTop: '20px',
                links: {
                    color: 'white'
                }
            },
            twitter: {
                borderRadius:"50%",
                background:"#148bcd",
                color: "white",
                height:"35px",
                width:"35px",
                lineHeight: "35px",
                display: "inline-block",
                marginRight: "6px",
                paddingLeft: "6px"
            },
            facebook: {
                borderRadius:"50%",
                background:"#29487d",
                color: "white",
                height:"35px",
                width:"35px",
                lineHeight: "35px",
                display: "inline-block",
                marginRight: "6px",
                paddingLeft: "6px"
            },
            googlePlus: {
                borderRadius:"50%",
                background:"#e64847",
                color: "white",
                height:"35px",
                width:"35px",
                lineHeight: "35px",
                display: "inline-block",
                marginRight: "6px",
                paddingLeft: "6px"
            },
            linkedIn: {
                borderRadius:"50%",
                background:"#007dba",
                color: "white",
                height:"35px",
                width:"35px",
                lineHeight: "35px",
                display: "inline-block",
                marginRight: "6px",
                paddingLeft: "6px"
            },
            portraitBackdrop: {
                position: 'absolute'
            },

        },
    };

    let twitterIcon = '';
    let facebookIcon = '';
    let googlePlusIcon = '';
    let linkedInIcon = '';

    if (twitter.length > 2) {
        twitterIcon = (
            <div style={styles.for.twitter}>
                <a href={twitter} target="_blank" style={styles.for.socialMediaContainer.links}>
                    <Icon type="fab" icon="twitter" />
                </a>
            </div> );
    }

    if (facebook.length > 2) {
        facebookIcon = (
            <div style={styles.for.facebook}>
                <a href={facebook} target="_blank" style={styles.for.socialMediaContainer.links}>
                    <Icon type="fab" icon="facebook-f" />
                </a>
            </div> );
    }

    if (google_plus.length > 2) {
        googlePlusIcon = (
            <div style={styles.for.googlePlus}>
                <a href={google_plus} target="_blank" style={styles.for.socialMediaContainer.links}>
                    <Icon type="fab" icon="google-plus-g" />
                </a>
            </div> );
    }

    if (linkedIn.length > 2) {
        linkedInIcon = (
            <div style={styles.for.linkedIn}>
                <a href={linkedIn} target="_blank" style={styles.for.socialMediaContainer.links}>
                    <Icon type="fab" icon="linkedin-in" />
                </a>
            </div> );
    }

    return (
        <div className="social-icons-container" style={styles.for.socialMediaContainer}>
            { twitterIcon }
            { facebookIcon}
            { googlePlusIcon }
            { linkedInIcon }
        </div>
    );
}

SocialMedia.propTypes = {
    /** myProp */
    twitter: PropTypes.string,
    facebook: PropTypes.string,
    google_plus: PropTypes.string,
    linkedIn: PropTypes.string
};

SocialMedia.defaultProps = {
    twitter: "",
    facebook: "",
    google_plus: "",
    linkedIn: ""
};

export default SocialMedia;