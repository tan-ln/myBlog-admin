import axios from 'axios'
import { blogListPrePageSize } from '../constants'


const types = {
  STATR_GET_BLOG_LIST: 'blogList/STATR_GET_BLOG_LIST',
  SUCCESS_GET_BLOG_LIST: 'blogList/SUCCESS_GET_BLOG_LIST',
  FAILURE_GET_BLOG__LIST: 'blogList/FAILURE_GET_BLOG__LIST'
}

const initState = {
  status: '',
  list: [],
  amount: 0,
  page: 1
}

export default (state = initState, action) => {
  switch (action.type) {
    case types.STATR_GET_BLOG_LIST:
      return {
        ...state,
        status: 'pedding'
      }
    case types.SUCCESS_GET_BLOG_LIST:
      return {
        ...state,
        status: 'success',
        list: action.data.list,
        amount: action.data.count,
        page: action.data.page
      }
    case types.FAILURE_GET_BLOG__LIST:
      return {
        ...state,
        status: 'failure'
      }
    default:
      return state
  }
}

// actions
const startGetBlogList = () => ({
  type: types.STATR_GET_BLOG_LIST
})
const successGetBlogList = (list, count, page) => ({
  type: types.SUCCESS_GET_BLOG_LIST,
  data: {
    list,
    count,
    page
  }
})
const failureGetBlogList = () => ({
  type: types.FAILURE_GET_BLOG__LIST
})


// 发送获取博客请求
const requestGetBlogList = (page = 1, limit = blogListPrePageSize) => dispatch => {
  dispatch(startGetBlogList())
  return axios.get(`/blog/lists`, {
    params: {
      page,
      limit
    }
  }).then(res => {
    if (res.data.code === 1) {
      const { list, amount } = res.data

      list.forEach((item, index) => {
        list[index].tags = item.tags.split(',')
      })

      dispatch(successGetBlogList(list, amount, page))
    }

  }).catch(error => {
    dispatch(failureGetBlogList())
    console.log(error.response)
  })
}

// 删除博客
const requestDeleteBlog = id => dispatch => {
  return axios.delete(`/blog/delete/${id}`).then(res => {
    return res.data.code === 1 ? 'success' : 'failure'
  }).catch(error => {
    console.log(error.response)
    return 'failure'
  })
}

// 更新博客
const requestUpdateBlog = (blog) => dispatch => {
  
  return axios.put(`/blog/update`, {
    blog
  }).then(res => {
    if (res.data.code === 1) {
      console.log(res.data)
      return 'success'
    }
  }).catch(error => {
    console.log(error.response)
    return 'failure'
  })
}

export {
  requestGetBlogList,
  requestDeleteBlog,
  requestUpdateBlog
}
