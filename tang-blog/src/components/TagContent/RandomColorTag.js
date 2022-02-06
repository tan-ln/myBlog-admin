import React from 'react'
import PropTypes from 'prop-types'
import { Tag } from 'antd'

// 标签颜色参数数组
const colors = ['magenta', 'red', 'volcano', 'orange', 'gold', 'lime', 'green', 'cyan', 'blue', 'geekblue', 'purple', '#108ee9', '#87d068', '#2db7f5', '#f50', 
'Aqua',	'Black',	'Fuchsia',	'Gray',	'Lime',	'Maroon',	'Navy',
'Silver',	'Teal',	'Yellow',	'Olive',
'#993300',	'#FF0000',	'#CC6633',	'#CC9933',
'#FF9933',	'#330000',	'#993333',	'#CC3333',	'#CC0000',
'#663399',	'#3333FF',	'#006699',	'#6633CC',	'#3333CC',
'#FF3366',	'#993366',	'#CC0066',	'#CC0033',	'#FF0066',
'#CCCC00',	'#CCC33	','#336666',	'#006600',	'#003300',	'#669933',	'#339966',	'#339999',
]


const randomColor = () => colors[Math.floor(Math.random() * 100 % 38)]

class RandomColorTag extends React.Component {

  constructor(props) {
    super(props)
    this.state = {
      color: randomColor()
    }
  }

  render() {
    const { children, ...props } = this.props

    return (
      <Tag {...props} color={this.state.color}>
        {children}
      </Tag>
    )
  }
}

RandomColorTag.propTypes = {
  children: PropTypes.node
}

export default RandomColorTag
