const smartgrid = require('smart-grid');

const settings = {
	filename: "_smart-grid",
	outputStyle: 'styl',
	breakPoints: {
        lg: {
            width: "1200px"
        },
        md: {
            width: "992px",
            fields: "15px"
        },
        sm: {
            width: "740px"
        },
        xs: {
            width: "576px"
        }
    },
    container: {
        maxWidth: "1900px",
        fields: "30px"
    },
    columns: 12,
}

smartgrid('./src/css/libs', settings);