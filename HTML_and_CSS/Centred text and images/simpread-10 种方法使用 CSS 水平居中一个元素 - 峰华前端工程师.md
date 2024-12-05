> 本文由 [简悦 SimpRead](http://ksria.com/simpread/) 转码， 原文地址 [zxuqian.cn](https://zxuqian.cn/how-to-horizontally-center-an-element-using-css/)

> 深入了解多种 CSS 水平居中技巧，提升您的网页设计能力，打造视觉效果出众的用户体验。探索这个全面的指南，成为 CSS 居中专家！

2023 年 3 月 · 预计阅读时间： 2 分钟

使用 text-align 居中行内元素[​](#使用-text-align-居中行内元素 "Direct link to heading")
-----------------------------------------------------------------------

`text-align` 不仅可以居中文本，还可以居中行内元素（如文本或图片）。把父元素的'text-align' 设置为 `center`，然后把子元素的 `display` 属性设置为 `inline` 就可以了。

```
.parent-element {
  text-align: center;
}


```

使用 display: inline-block 居中[​](#使用-display-inline-block-居中 "Direct link to heading")
------------------------------------------------------------------------------------

这个和第一种方式类似，因为 `inline-block` 属于行内的块级元素，它也会受 `text-align` 的影响，从而进行水平居中。在父元素上设置 `text-align: center`，然后把要居中的元素的 `display` 属性设置为 `inline-block` 就可以了。

```
.parent-element {
  text-align: center;
}

.centered-element {
  display: inline-block;
}


```

使用已知宽度的块级元素居中[​](#使用已知宽度的块级元素居中 "Direct link to heading")
---------------------------------------------------------

对于具有指定宽度的块级元素，可以利用 `margin` 属性来居中它本身，只需要把左右边距都设置为 `auto` 就可以了，它会让元素在容器内自动居中。

```
.block-element {
  width: 50%;
  margin-left: auto;
  margin-right: auto;
}


```

或者：

```
.block-element {
  width: 50%;
  margin: 0 auto;
}


```

使用 Flexbox 居中元素[​](#使用-flexbox-居中元素 "Direct link to heading")
-------------------------------------------------------------

Flexbox 是现代的、功能强大、并且兼容性良好的 CSS 布局方式，可以很简单的就实现块级元素的居中。只需要把 `display: flex` 和 `justify-content: center` 设置给要居中的元素的父元素就可以了。

```
.parent-container {
  display: flex;
  justify-content: center;
}


```

使用 CSS Grid 居中元素[​](#使用-css-grid-居中元素 "Direct link to heading")
---------------------------------------------------------------

CSS Grid 是比 flex 更强大的布局系统，是一种比较新的布局方式，兼容性可能不及 flex 布局，但是它能帮你实现复杂的响应式网页设计。要在 Grid 布局里水平居中元素，可以在父元素上设置 `display: grid` 和 `justify-items: center` 属性。

```
.grid-container {
  display: grid;
  justify-items: center;
}


```

使用 display: grid 和 place-items: center 居中[​](#使用-display-grid-和-place-items-center-居中 "Direct link to heading")
---------------------------------------------------------------------------------------------------------------

这种方法利用了 CSS Grid 布局的简化设置属性，在父元素上设置 `display: grid`，然后使用 `place-items: center` 同时进行水平和垂直居中。如果只需要水平居中，可以使用 `place-items: center start`。

```
.grid-container {
  display: grid;
  place-items: center;
}


```

居中 absolute 绝对定位元素[​](#居中-absolute-绝对定位元素 "Direct link to heading")
-------------------------------------------------------------------

对于绝对定位元素，即 `position` 设置为 `absolute` 的元素，可以把 `left` 属性值设置为 50%，然后再利用 `transform` 属性，通过 `translateX()` 函数，把元素水平偏移 -50%， 也就是向左偏移，来实现居中。

```
.absolute-element {
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
}


```

使用 calc() 函数居中[​](#使用-calc-函数居中 "Direct link to heading")
---------------------------------------------------------

对于绝对定位元素，还可以使用 `calc()` 函数来进行水平居中。将 `left` 属性设置为 `calc(50% - 元素宽度的一半)`。

```
.absolute-element {
  position: absolute;
  width: 200px;
  left: calc(50% - 100px);
}


```

使用 position: sticky 居中[​](#使用-position-sticky-居中 "Direct link to heading")
--------------------------------------------------------------------------

`position: sticky` 可用于实现相对于视口 (viewport) 或包含块 (containing block) 的居中。将元素的 `position` 属性设置为 `sticky`，然后使用 `left` 和 `calc()` 函数来设置元素的水平位置。

```
.sticky-element {
  position: sticky;
  left: calc(50% - 元素宽度的一半);
}


```

使用 display: table 和 display: table-cell 居中[​](#使用-display-table-和-display-table-cell-居中 "Direct link to heading")
-----------------------------------------------------------------------------------------------------------------

这种方法借鉴了 HTML 传统的表格布局的思路，通过将父元素设置为 `display: table`，子元素设置为 `display: table-cell`，然后在子元素中应用 `text-align: center` 实现居中。

```
.parent-element {
  display: table;
  width: 100%;
}

.child-element {
  display: table-cell;
  text-align: center;
}


```

结论[​](#结论 "Direct link to heading")
-----------------------------------

以上是一些常见的水平居中方法，了解这些方法之后，你就可以在不同场景下实现元素的水平居中。结合实际需求选择合适的方法，让你开发中减少错误，提高效率，省下的时间可以学习新技术或者摸鱼~