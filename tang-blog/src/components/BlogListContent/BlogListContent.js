import React from 'react'
import { Divider } from 'antd'
import Styled from 'styled-components'
import BlogList from './BlogList'
import { Layout, Typography } from 'antd'

const { Title } = Typography
const { Content } = Layout

const StyledContent = Styled(Content)`
  &&& {
    margin: 24px;
    padding: 30px;
    background: #fff;
    min-width: 620px;
    box-sizing: border-box;
    overflow-x: hidden;
    overflow-y: scroll;
  }
`
const BlogListContent = () => (
  <StyledContent>
    <Title level={4}>文章列表</Title>
    <Divider dashed />
    <BlogList />
  </StyledContent>
)

export default BlogListContent
