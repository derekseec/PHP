> 本文由 [简悦 SimpRead](http://ksria.com/simpread/) 转码， 原文地址 [juejin.cn](https://juejin.cn/post/6844903550909153287)

使用绝对定位和负外边距对块级元素进行垂直居中
----------------------

_HTML_

```
<div id="box">
    <div id="child"></div>
</div>


```

_CSS_

```
#box {
    width: 300px;
    height: 300px;
    background: #ddd;
    position: relative;
}
#child {
    width: 150px;
    height: 100px;
    background: orange;
    position: absolute;
    top: 50%;
    margin: -50px 0 0 0; 
}


```

![][img-0]

这个方法兼容性不错，但是有一个小缺点：必须提前知道被居中块级元素的尺寸，否则无法准确实现垂直居中。

使用绝对定位和 transform
-----------------

_HTML_

```
<div id="box">
    <div id="child">test vertical align</div>
</div>


```

_CSS_

```
#box {
    width: 300px;
    height: 300px;
    background: #ddd;
    position: relative;
}
#child {
    background: orange;
    position: absolute;
    top: 50%;
    transform: translate(0, -50%);
}


```

![][img-1]

这种方法有一个明显的好处就是不必提前知道被居中元素的尺寸了，因为 `transform` 中 `translate` 偏移的百分比就是相对于元素自身的尺寸而言的。

另外一种使用绝对定位和负外边距进行垂直居中的方式
------------------------

_HTML_

```
<div id="box">
    <div id="child">test vertical align</div>
</div>


```

_CSS_

```
#box {
    width: 300px;
    height: 300px;
    background: #ddd;
    position: relative;
}
#child {
    width: 50%;
    height: 30%;
    background: orange;
    position: absolute;
    top: 50%;
    margin: -15% 0 0 0;
}


```

![][img-2]

这种方式的原理实质上和前两种相同。补充的一点是：`margin` 的取值也可以是百分比，这时这个值规定了该元素基于父元素尺寸的百分比，可以根据实际的使用场景来决定是用具体的数值还是用百分比。

绝对定位结合 margin: auto
-------------------

_HTML_

```
<div id="box">
    <div id="child">test vertical align</div>
</div>


```

_CSS_

```
#box {
    width: 300px;
    height: 300px;
    background: #ddd;
    position: relative;
}
#child {
    width: 200px;
    height: 100px;
    background: orange;
    position: absolute;
    top: 0;
    bottom: 0;
    margin: auto;
    line-height: 100px;
}


```

![][img-3]

这种实现方式的两个核心是：把要垂直居中的元素相对于父元素绝对定位，top 和 bottom 设为相等的值，我这里设成了 0，当然也可以设为 99999px 或者 -99999px 无论什么，只要两者相等就行，这一步做完之后再将要居中元素的 `margin` 属性值设为 `auto`，这样便可以实现垂直居中了。

被居中元素的宽高也可以不设置，但不设置的话就必须是图片这种自身就包含尺寸的元素，否则无法实现。

使用 padding 实现子元素的垂直居中
---------------------

_HTML_

```
<div id="box">
    <div id="child"></div>
</div>


```

_CSS_

```
#box {
    width: 300px;
    background: #ddd;
    padding: 100px 0;
}
#child {
    width: 200px;
    height: 100px;
    background: orange;
}


```

![][img-4]

这种实现方式非常简单，给父元素设置相等的上下内边距，子元素自然是垂直居中的，当然这时候父元素是不能设置高度的，要让它自动被填充起来，除非设置了一个正好等于上内边距 + 子元素高度 + 下内边距的值，否则无法精确垂直居中。

这种方式看似没有什么技术含量，但其实在某些场景下也是非常好用的。

设置第三方基准
-------

_HTML_

```
<div id="box">
    <div id="base"></div>
    <div id="child"></div>
</div>


```

_CSS_

```
#box {
    width: 300px;
    height: 300px;
    background: #ddd;
}
#base {
    height: 50%;
    background: orange;
}
#child {
    height: 100px;
    background: rgba(131, 224, 245, 0.6); 
    margin-top: -50px;
}


```

![][img-5]

这种方式也非常简单，首先设置一个高度等于父元素高度一半的第三方基准元素，这时该基准元素的底边线就是父元素纵向上的中分线，做完这些之后再给要垂直居中的元素设置一个 `margin-top` 属性，值的大小是它自身高度的一半取负，则实现垂直居中。

使用 flex 布局
----------

_HTML_

```
<div id="box">test vertical align</div>


```

_CSS_

```
#box {
    width: 300px;
    height: 300px;
    background: #ddd;
    display: flex;
    align-items: center;
}


```

![][img-6]

这种方式同样适用于块级元素：

_HTML_

```
<div id="box">
    <div id="child"></div>
</div>


```

_CSS_

```
#box {
    width: 300px;
    height: 300px;
    background: #ddd;
    display: flex;
    align-items: center;
}
#child {
    width: 300px;
    height: 100px;
    background: orange;
}


```

![][img-7]

flex 布局请参考阮一峰[《felx 布局教程》](https://link.juejin.cn?target=http%3A%2F%2Fwww.ruanyifeng.com%2Fblog%2F2015%2F07%2Fflex-grammar.html "http://www.ruanyifeng.com/blog/2015/07/flex-grammar.html")

flex 也就是 flexible，意为灵活的、柔韧的、易弯曲的。

元素可以通过设置 `display:flex;` 将其指定为 flex 布局的容器，指定好了容器之后再为其添加 `align-items` 属性，该属性定义项目在交叉轴（这里是纵向轴）上的对齐方式，可能的取值有五个，分别如下：   

*   flex-start:：交叉轴的起点对齐
*   flex-end：交叉轴的终点对齐
*   center：交叉轴的中点对齐
*   baseline：项目第一行文字的基线对齐
*   stretch（该值是默认值）：如果项目没有设置高度或者设为了 auto，那么将占满整个容器的高度

第二种使用弹性布局的方式
------------

_HTML_

```
<div id="box">
    <div id="child"></div>
</div>


```

_CSS_

```
#box {
    width: 300px;
    height: 300px;
    background: #ddd;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
#child {
    width: 300px;
    height: 100px;
    background: orange;
}


```

![][img-8]

这种方式也是首先给父元素设置 `display:flex;` 设置好之后改变主轴的方向 `flex-direction: column;` 该属性可能的取值有四个，分别如下：   

*   row（该值为默认值）：主轴为水平方向，起点在左端
*   row-reverse：主轴为水平方向，起点在右端
*   column：主轴为垂直方向，起点在上沿
*   column-reverse：主轴为垂直方向，起点在下沿

`justify-content` 属性定义了项目在主轴上的对齐方式，可能的取值有五个，分别如下（具体的对齐方式与主轴的方向有关，以下假定主轴方向为默认的从左到右）：

*   flex-start（该值是默认值）：左对齐
*   flex-end：右对齐
*   center：居中对齐
*   space-between：两端对齐，各个项目之间的间隔均相等
*   space-around：各个项目两侧的间隔相等

使用 `line-height` 对单行文本进行垂直居中
----------------------------

_HTML_

```
<div id="box">test vertical align</div>


```

_CSS_

```
#box{
    width: 300px;
    height: 300px;
    background: #ddd;
    line-height: 300px;
}


```

![][img-9]

要注意的是，`line-height` (行高) 的值不能设为 `100%`，我们来看看官方文档中给出的关于 `line-height` 取值为百分比时候的描述：“基于当前字体尺寸的百分比行间距”。也就是说，这里的百分比并不是相对于容器元素尺寸而言的，而是相对于字体尺寸。

使用 `line-height` 和 `vertical-align` 对图片进行垂直居中
---------------------------------------------

_HTML_

```
<div id="box">
    <img src="smallpotato.jpg">
</div>


```

_CSS_

```
#box{
    width: 300px;
    height: 300px;
    background: #ddd;
    line-height: 300px;
}
#box img {
    width: 200px;
    height: 200px;
    vertical-align: middle;
}


```

![][img-10]

`vertical-align` 并不像看起来那样天真无邪，深入研究请参考张鑫旭 [我对 CSS vertical-align 的一些理解与认识](https://link.juejin.cn?target=http%3A%2F%2Fwww.zhangxinxu.com%2Fwordpress%2F2010%2F05%2F%25E6%2588%2591%25E5%25AF%25B9css-vertical-align%25E7%259A%2584%25E4%25B8%2580%25E4%25BA%259B%25E7%2590%2586%25E8%25A7%25A3%25E4%25B8%258E%25E8%25AE%25A4%25E8%25AF%2586%25EF%25BC%2588%25E4%25B8%2580%25EF%25BC%2589%2F "http://www.zhangxinxu.com/wordpress/2010/05/%E6%88%91%E5%AF%B9css-vertical-align%E7%9A%84%E4%B8%80%E4%BA%9B%E7%90%86%E8%A7%A3%E4%B8%8E%E8%AE%A4%E8%AF%86%EF%BC%88%E4%B8%80%EF%BC%89/")

本例具体的实现原理请参考张鑫旭 [CSS 深入理解 vertical-align 和 line-height 的基友关系](https://link.juejin.cn?target=http%3A%2F%2Fwww.zhangxinxu.com%2Fwordpress%2F2015%2F08%2Fcss-deep-understand-vertical-align-and-line-height%2F "http://www.zhangxinxu.com/wordpress/2015/08/css-deep-understand-vertical-align-and-line-height/")

使用 `display: table;` 和 `vertical-align: middle;` 对容器里的文字进行垂直居中
--------------------------------------------------------------

_HTML_

```
<div id="box">
    <div id="child">test vertical align</div>
</div>


```

_CSS_

```
#box {
    width: 300px;
    height: 300px;
    background: #ddd;
    display: table;
}
#child {
    display: table-cell;
    vertical-align: middle;
}


```

![][img-11]

`vertical-align` 属性只对拥有 `valign` 特性的 html 元素起作用，例如表格元素中的 `<td> <th>` 等等，而像 `<div> <span>` 这样的元素是不行的。

`valign` 属性规定单元格中内容的垂直排列方式，语法：`<td valign="value">`，value 的可能取值有以下四种：

*   top：对内容进行上对齐
*   middle：对内容进行居中对齐
*   bottom：对内容进行下对齐
*   baseline：基线对齐

关于 `baseline`：基线是一条虚构的线，在一行文本中，大多数字母以基线为基准。`baseline` 值设置行中的所有表格数据都分享相同的基线。该值的效果在文本的字号各不相同时效果会更好，请看下例：

_HTML_

```
<div id="box">
    <div class="child">glory</div>
    <div class="child">glad</div>
    <div class="child">align</div>
</div>


```

_CSS_

```
#box {
    width: 300px;
    height: 300px;
    background: #ddd;
    display: table;
}
.child {
    display: table-cell;
    vertical-align: top;
    border-right: 1px solid orange;
}
.child:first-child {
    font-size: 30px;
}
.child:last-child {
    font-size: 50px;
}


```

![][img-12]

如果将 `vertical-align` 属性的值修改为 `baseline`，效果更好：

![][img-13]

使用 CSS Grid
-----------

_HTML_

```
<div id="box">
    <div class="one"></div>
    <div class="two">target item</div>
    <div class="three"></div>
</div>


```

_CSS_

```
#box {
    width: 300px;
    height: 300px;
    display: grid;
}
.two {
    background: orange;
}
.one, .three {
    background: skyblue;
}


```

![][img-14]

这种场景下使用 `Grid Layout` 非常方便，只需要设置 `.one .three` 两个辅助元素即可，只是 Grid 布局现在[浏览器支持度](https://link.juejin.cn?target=https%3A%2F%2Fcaniuse.com%2F%23search%3Dgrid "https://caniuse.com/#search=grid")还比较低。

_使用 CSS Grid 设置水平居中_

_HTML_

```
<div id="box">
    <div></div>
    <div class="two">target item</div>
    <div></div>
</div>


```

_CSS_

```
#box {
    width: 300px;
    height: 300px;
    background: #ddd;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
}
.two {
    background: orange;
}


```

![][img-15]

同样的添加两个辅助元素，然后将 `grid-template-columns` 属性值设置为 `1fr 1fr 1fr`，意为三列子元素等分全部可用宽度。

也会有这样的场景，需要被居中的元素宽度已知，则：

_HTML_

```
<div id="box">
    <div></div>
    <div class="two">target item</div>
    <div></div>
</div>


```

_CSS_

```
#box {
    width: 300px;
    height: 300px;
    background: #ddd;
    display: grid;
    grid-template-columns: 1fr 211px 1fr;
}
.two {
    background: orange;
}


```

![][img-16]

#box 里的第一个 div 和最后一个 div 会平分全部剩余可用宽度，作为自身的宽度，即 (300px - 211px) / 2，各自 44.5px。

[img-0]:data:image/webp;base64,UklGRo4BAABXRUJQVlA4IIIBAADQHQCdASosASwBPpFIoUwlpCMiIl9YALASCWdu4XasC6+AfkBpgPxAlgH8AtwDJAPJG/YAA6kj5dzeApRjO8VmXi9M7xWZeL0zvFZl4vTO8VmXi9M7xWZeL0zvFZl4vTO8VmXi9M7xWZeLyn2Og2fJSbBhjcD3j9xi5f7yeZeL0zvFYXrSDJy9p3isypuOy9p3isy8XlYdhM7xWZeL0yuHYTO8VmXi9Mrh2EzvFK3Y5zEbge8fuMmviUmgSV5C0XTzLxfAX+pgFLBk5e07xWZeL0zvFZl4vTO8VmXi9M7xWZeL0zvFZl4vTO8VmXi9M7xWZeL0zukAAP73AAAAAAACYoOGzB69s9U4V+/zK/3yNk10vBVw89sNbFzK6bcUgcIx4RjwjHhGPCMc4932FgZMw9PYzeP9usjRB/efpqidkmI8fAgs6whb4YAnvzDKnLUUjQDge5gAAAy+Y5rV9PlntaY2E3I22M5nZPBlk7glMB+0FGF5JMAihTuHkcoAAAAAAA==

[img-1]:data:image/webp;base64,UklGRpgFAABXRUJQVlA4IIwFAAAwKwCdASosASwBPpFIoEylpKMiINv4cLASCWdu4XX5yPF1D9+h1aPUBtgPMB5qf+Y9QHkgerL/ePYA/Zn2AP2A9M72If73/0rCh+v42lud+X4VZWNxn+jf6/wFv470N7y/CfeLeVV6Zudd6b9gb9bOswDi1gzSmyCeZmL2QTzMxeyCeZmL2QTzMxeyCeZmL2QTzMxeyCeZmL2QTzMxeyCeZmL2QTzMxeyCeZmL2QTzMxeyCeZmHZhmnqzfXdyYZm+u7aPuWtkE8y4P3MFP6wwPFWATN6nZLvOrHfYoyBHwk5nM5Ig0OAAL4WiRagYLdBFZBvGNAhHZIACOTAXOgd48bPoZi9kDlnJKL4F5Oojvv1yasCX/YRTgvxWZmL2iAKDq3obIJ5mYvZBPMzF7IJ5mYvZBPMzF7IJ5mYvZBPMzF7IJ5mYvZBPMzF7IJ5mYvZBPMzF7IJ5mYvZBPMzF7IJ5lwAA/v9uWAAAAAAABpcKJAOSb9//8oT7niTf6yvN/bX//FqUGF++6UGAJEY27KAjLbsoCMtuygFIB5nzYBdrysPGZ38KumXDzTZ3O8OfeZIbY79Yqu0+AaY2da3czN6MbNt5OM01r2gbOHd9x//E6cfTsPZltsGNxrhyj/x50f9Uyh4DdEwtr/b/3oGiTOYnCnLxqXNEZrQWB9jFveCwqsMnCPaaF5Nlq6MFcEfiDLaST/vDSJQw9aQqP62Hzq44KlUC1cv/206pEdJS9/wAu9rq7F9NdzKrziKlHIrk77DJBO88MU2wAaNifaqquji5sAEV1STVSCBmqJHYN1lqINe7dJBZ6nht2wVyK4sXzHw2tbLyvgd/URz4aS/rubZcmPQeJc64n9C735fXValGrfUVdInlpdxQvPhntHeP8WnXFlGDOhqA7RgarLBAZZeXEv66aH0nD46MZ27VDJ3ZJByL1BFVrOWFVVI2u3QZ7vUX/4zyVMxZd9dbmeTEOZBqBA6gjCpUpEu+fQ5VWmbg7wPjio41b0Jajns/pYCXai1CcDT0X5zJs89upjjccBRhACiAEjz3GPO1akDqDzAyH7SPeyD462Uo8b0fwC3N8UPoifrARfwlkLzzkZ1JGnKdbpPN5pPgihyPNaMJ5RF3rP/9ThxMNnb/myUsZ/fERYfb/t2JX763vt6tCXpkQ/53/mirj9rf+sk2LqgWmnM2ClMdssoeZP9Vkzpyu8x5wF2D/OXDB54b0zeJJZlbcMmjKhlT/T6GCJ8pfvZrIYJ99Tgb2z8k0PCHAEMCLkZsW1m8HB/hqKDGPuZRb8Fkpk1A9XGxlBJy+eqAq7VaUwmvRCVfCrspl2w23p05Tb/KNBIMW9DvvKi+RuiFWFRmzx99lfmYbbp4rmVUun3q6iDnJjSDPdfNmL3qmlxvtLLnA+WrAnXZicdwxTLeeVCIwROXdbJa3iw6x1GrF9zO69/IGZlX7xapsnHq2pNhzLKCwWokA/8R7L5EI4P/xDMNwnGdvYrlizcEkOvfm3zFzjD3p42HGID2YhtLbAhzR8DdDxw0vqkC197OOtFOsz48yA5MEMp1GIx6TVL2tOGS4RgD4FM04F3GEuQyV3OJERdSXlyT6FB1Cefc/d17LtKFV1+cl6N2HB9W0MPSs0exCNGg34/qZvx7S5puDlnWJZfcUxwxF32EC0A8oLw5RWmxShJ7Mnk29Gl01BqFIqzwxHUs/J+8cHor2z3vDsvTzBuvEq/Qh/VqsEWZvQuPpXysO/BeBYr/uUlsjrPQ/Y1G/t+6d7xLTfET2G57sZC57vGYmTFmp9ip1m9T2EdVn4IJRG34jDqe+TAuj+X0VKZe3pDo21jX9lbECt47L8Iut2nYAMJRiM1u17Wk5yzcPg5mJ2yNIBAAAAAAAAAAAAAA

[img-2]:data:image/webp;base64,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

[img-3]:data:image/webp;base64,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

[img-4]:data:image/webp;base64,UklGRnwBAABXRUJQVlA4IHABAAAwHgCdASosASwBPpFIoEwlpCMiIv94ALASCWdu4XaxEYAH4S6YD8QJYB/ALj/uwD9gAEpvrNuSSH/Pkf/nyP/z5H/58j/8+R/+fI//Pkf/nyP/z5H/58j/8+R/+fI//Pkf/nyP/z5H/5PerHyTEC6KriRbCa3528hAuQw/utg5WupCkkP8fdQj/8+R/+fIlSIzG3UhSSH/KLQPUhSSH/Pke4fMfI//Pkf/njus2o4Z57gGJFsJrfnbyEC6KriRYjVAXKMxt1RnGMfjH4wmOVrqQpJD/nyP/z5H/58j/8+R/+fI//Pkf/nyP/z5H/58j/8+R/+fI//Pkf5AAP73AAAAAAAACyCPZIR93rUSal/mV/vkerathp0rDoq7W4ldMZYHpv+2f7Z/tn+2f7Z/tn+2f4sX2Am3OV4/CPYc0yYIA3OXXh00OAUkIHEDHpAge3Gz3DX5Z30MGI8llUmZGn33BX6BYDUEAxClUOtYQAAAAA==

[img-5]:data:image/webp;base64,UklGRt4BAABXRUJQVlA4INIBAACwIACdASosASwBPpFIoUwlpCMiI5DYcLASCWdu4XYA+cJP4ze5AYH45cID4gf1W4/7uAAAtJUFRxacbuALN6F7pOuLTjdwBZvQvdJ1xacbuALN6F7pOuLTjdwBZvQvdJ1xacbuALN6F6mhqFFzsdBtWFTywoDM6xc8epdqwqeWFAce7gCzehe6Tri043cAWb0L3RkQkYInXPHqXasKnlhQGZ1i549S7VhU8sK5wp7Yntie2J7YntidKACzehe6Trh2p8b1Le2ZbOxvUt7Zls7G9S3tmWzsb1Ls8QVHFpxu4As3oXuk64tON3AFm9C90nXFpxu4As3oXuk64tON3AFm9C90nXFpxu4As3oXuOAA/v7w1/Ks/zK/8yvwve2+LMcZ9uyhO8uIRs2rQEJE4YKVYZCVwOBAhCC66Kbu4A1zBvoT454NzdYdPJIkxuRmi7UHU048zJSgZJKUDJJSgZJNCQAAAA213x152xgnsyB6uoNXVnbauHXlz2/2zCm8VGDniowc8VGDniowc8ePOL4B+1IT9ExOYY/N2HeAcH2bvs7MbUYf8qZZEdyi/4r8V+K/FfivxX4r8V+K/FfivxX4r8V+K+QMgAAAAAAAAAAAAAAA

[img-6]:data:image/webp;base64,UklGRq4EAABXRUJQVlA4IKIEAACQKACdASosASwBPpFIoEylpCMiINgIELASCWlu4XaxHx5hXcnzbj9Df/h6fXoA53f0KdDX/t/YW/Yz2AP2A9bD1Vf9tggHXX/Uvxa6t5H3+U4QdpzdCOI/zv/R9+d/Gch39reNMmPf3L/XembnA+g/YD/l/9k6uIHPnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOjighs+sH8r71Nq1mYjOcrzMDYxArXlSwimu+QRpOwOz7DWnLNb3hpetaYuB1C+LEdMQpLpb9b114ec09ylxOUKNjbeaazp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOm+AA/v+edAAAAAJRxjfldcWhYW6vW9K1Ybh4xgnt7ZNQLO03f9Z5km+qaCc4pxEQOu3E+XE+QqA5ZI78sZL/+Fmfjc1GmHHWEtKMmR+fXs8bE9fOqauP7vDZIsiXlFnk8dH36mMMnMNF38rr9PORppv7qtyBvdaxVeTZAFUi+eAR3xo3p9iex/sRl05hr3W7+BkotaTmA/XtKAvcY3guTeGmbqkMlcvd2QVt0ilqeMNJxvKiR9ZCF0lUjX19nqdJPX6QBFLh7HEuht0oUGrjXPynr+4Mst9KjcCHfbZi2nDcD9VhnXRi71L7JTqmn2QHeC5OG3gGtm7qn2x58U9NWtWE07ufqvROaMjGiOZiPqDwBzOl4Xsebol7pPU/4GyWxEN31tKuJFKxM2bz2KIl4MKlHnzeE27tcRsL4laqRHjO5iJ12nxQx18QNXe9rT3BmXeGKdmeUCF0+YLaHiSHGWFZPAcJQXjWwOdM7Z07t/gVybdr2jDs72+8L6Ab7Gbxsa3R/dqUPgLoPSUU+64dH7h9JK+2BVw3M0/ztpETf/eZzcHGnUJH2XLEuq5QG4hYnQszcZHKFmmgWj/VsMG9LOtZIzuv6+XeWyLETaXgPpjJG7PLc/o0J9AaS+i7XsCz0Ga6lG02QXUP/N+Ur6TNeBBbxANXmc2zBeC7Mq1ZcnwU9gVbqRRGnxXYafDsQjiX4Pc7666nF8tF99e5emz5tOJVcPyml+3TdEa/5xplnuwioBLJI+PnV2fLe/rTWrjG5ghnJxbjWbmCIx9cwlHdmC2v28YC3dIGraPtsed/qjzdtlIUC/yfsY96Vm17O2l6A4F39pqDfn+kO/tuO6p97+bzSdtrah1uFiAnFOe1uU8PPBUL4PfIHb3+IPYqVFRjBt3RLIUiWecwv8areXhvZpM/h0XTRnZWzbYnnm3XLmAfp1nCqEs7pOhGTybJGd1v18y6XAu6YjHrSX81TJ26WFICMpyxD/QufxKFQlHwVFosQhGYaI4c1pmSJjIASMzduPzMjvFzGunVfAirFoG1kcMhK+h7TdtqCGWqV5s2N8bC+Lo9MYRn7Fruwv2cWL6zPQfWOv4iQ2utGDvB1AAABze3edq305/+gvC+UX5YAAAAAAAAAAAA

[img-7]:data:image/webp;base64,UklGRoABAABXRUJQVlA4IHQBAABQHgCdASosASwBPpFIoEulpCMho5+IALASCWdu4XaxCAAH4ge7wQH4VywD+AXH/dgACs31m3Jn4AdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwbOCsfJON+m7YOpjpASZlF2wdTHSAkzKLtjJAdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwbOGOc41oUN+m7YOpjpASZlF2wdTHSAkzNlUL1jk8oPorM8M7hSj1Sj1Sj1Sj1Sj1Sj1Sj1Sj1Sj1Sj1Sj1Sj1Sj1Sj1Sj1Sj1Sj1Sj1R8AAD+9wAAAAAAAAABzcLjnhEUm56p70m/8yv98jzPr7SGOjptR28qxuG3PIeXHlx5ceXHlx5ceXHlx5ceXHlx5ceXHlx5dRgIlIKEgBbRAAAAAeO/V12KL8s45hU2keQgG1gbWBtYG1enUtQv4nNKDkMUbhylKNw4AAA=

[img-8]:data:image/webp;base64,UklGRoABAABXRUJQVlA4IHQBAABQHgCdASosASwBPpFIoEulpCMho5+IALASCWdu4XaxCAAH4ge7wQH4VywD+AXH/dgACs31m3Jn4AdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwbOCsfJON+m7YOpjpASZlF2wdTHSAkzKLtjJAdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwdmwbOGOc41oUN+m7YOpjpASZlF2wdTHSAkzNlUL1jk8oPorM8M7hSj1Sj1Sj1Sj1Sj1Sj1Sj1Sj1Sj1Sj1Sj1Sj1Sj1Sj1Sj1Sj1Sj1Sj1R8AAD+9wAAAAAAAAABzcLjnhEUm56p70m/8yv98jzPr7SGOjptR28qxuG3PIeXHlx5ceXHlx5ceXHlx5ceXHlx5ceXHlx5dRgIlIKEgBbRAAAAAeO/V12KL8s45hU2keQgG1gbWBtYG1enUtQv4nNKDkMUbhylKNw4AAA=

[img-9]:data:image/webp;base64,UklGRq4EAABXRUJQVlA4IKIEAACQKACdASosASwBPpFIoEylpCMiINgIELASCWlu4XaxHx5hXcnzbj9Df/h6fXoA53f0KdDX/t/YW/Yz2AP2A9bD1Vf9tggHXX/Uvxa6t5H3+U4QdpzdCOI/zv/R9+d/Gch39reNMmPf3L/XembnA+g/YD/l/9k6uIHPnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOjighs+sH8r71Nq1mYjOcrzMDYxArXlSwimu+QRpOwOz7DWnLNb3hpetaYuB1C+LEdMQpLpb9b114ec09ylxOUKNjbeaazp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOm+AA/v+edAAAAAJRxjfldcWhYW6vW9K1Ybh4xgnt7ZNQLO03f9Z5km+qaCc4pxEQOu3E+XE+QqA5ZI78sZL/+Fmfjc1GmHHWEtKMmR+fXs8bE9fOqauP7vDZIsiXlFnk8dH36mMMnMNF38rr9PORppv7qtyBvdaxVeTZAFUi+eAR3xo3p9iex/sRl05hr3W7+BkotaTmA/XtKAvcY3guTeGmbqkMlcvd2QVt0ilqeMNJxvKiR9ZCF0lUjX19nqdJPX6QBFLh7HEuht0oUGrjXPynr+4Mst9KjcCHfbZi2nDcD9VhnXRi71L7JTqmn2QHeC5OG3gGtm7qn2x58U9NWtWE07ufqvROaMjGiOZiPqDwBzOl4Xsebol7pPU/4GyWxEN31tKuJFKxM2bz2KIl4MKlHnzeE27tcRsL4laqRHjO5iJ12nxQx18QNXe9rT3BmXeGKdmeUCF0+YLaHiSHGWFZPAcJQXjWwOdM7Z07t/gVybdr2jDs72+8L6Ab7Gbxsa3R/dqUPgLoPSUU+64dH7h9JK+2BVw3M0/ztpETf/eZzcHGnUJH2XLEuq5QG4hYnQszcZHKFmmgWj/VsMG9LOtZIzuv6+XeWyLETaXgPpjJG7PLc/o0J9AaS+i7XsCz0Ga6lG02QXUP/N+Ur6TNeBBbxANXmc2zBeC7Mq1ZcnwU9gVbqRRGnxXYafDsQjiX4Pc7666nF8tF99e5emz5tOJVcPyml+3TdEa/5xplnuwioBLJI+PnV2fLe/rTWrjG5ghnJxbjWbmCIx9cwlHdmC2v28YC3dIGraPtsed/qjzdtlIUC/yfsY96Vm17O2l6A4F39pqDfn+kO/tuO6p97+bzSdtrah1uFiAnFOe1uU8PPBUL4PfIHb3+IPYqVFRjBt3RLIUiWecwv8areXhvZpM/h0XTRnZWzbYnnm3XLmAfp1nCqEs7pOhGTybJGd1v18y6XAu6YjHrSX81TJ26WFICMpyxD/QufxKFQlHwVFosQhGYaI4c1pmSJjIASMzduPzMjvFzGunVfAirFoG1kcMhK+h7TdtqCGWqV5s2N8bC+Lo9MYRn7Fruwv2cWL6zPQfWOv4iQ2utGDvB1AAABze3edq305/+gvC+UX5YAAAAAAAAAAAA

[img-10]:data:image/webp;base64,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

[img-11]:data:image/webp;base64,UklGRq4EAABXRUJQVlA4IKIEAACQKACdASosASwBPpFIoEylpCMiINgIELASCWlu4XaxHx5hXcnzbj9Df/h6fXoA53f0KdDX/t/YW/Yz2AP2A9bD1Vf9tggHXX/Uvxa6t5H3+U4QdpzdCOI/zv/R9+d/Gch39reNMmPf3L/XembnA+g/YD/l/9k6uIHPnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOjighs+sH8r71Nq1mYjOcrzMDYxArXlSwimu+QRpOwOz7DWnLNb3hpetaYuB1C+LEdMQpLpb9b114ec09ylxOUKNjbeaazp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOnTp06dOm+AA/v+edAAAAAJRxjfldcWhYW6vW9K1Ybh4xgnt7ZNQLO03f9Z5km+qaCc4pxEQOu3E+XE+QqA5ZI78sZL/+Fmfjc1GmHHWEtKMmR+fXs8bE9fOqauP7vDZIsiXlFnk8dH36mMMnMNF38rr9PORppv7qtyBvdaxVeTZAFUi+eAR3xo3p9iex/sRl05hr3W7+BkotaTmA/XtKAvcY3guTeGmbqkMlcvd2QVt0ilqeMNJxvKiR9ZCF0lUjX19nqdJPX6QBFLh7HEuht0oUGrjXPynr+4Mst9KjcCHfbZi2nDcD9VhnXRi71L7JTqmn2QHeC5OG3gGtm7qn2x58U9NWtWE07ufqvROaMjGiOZiPqDwBzOl4Xsebol7pPU/4GyWxEN31tKuJFKxM2bz2KIl4MKlHnzeE27tcRsL4laqRHjO5iJ12nxQx18QNXe9rT3BmXeGKdmeUCF0+YLaHiSHGWFZPAcJQXjWwOdM7Z07t/gVybdr2jDs72+8L6Ab7Gbxsa3R/dqUPgLoPSUU+64dH7h9JK+2BVw3M0/ztpETf/eZzcHGnUJH2XLEuq5QG4hYnQszcZHKFmmgWj/VsMG9LOtZIzuv6+XeWyLETaXgPpjJG7PLc/o0J9AaS+i7XsCz0Ga6lG02QXUP/N+Ur6TNeBBbxANXmc2zBeC7Mq1ZcnwU9gVbqRRGnxXYafDsQjiX4Pc7666nF8tF99e5emz5tOJVcPyml+3TdEa/5xplnuwioBLJI+PnV2fLe/rTWrjG5ghnJxbjWbmCIx9cwlHdmC2v28YC3dIGraPtsed/qjzdtlIUC/yfsY96Vm17O2l6A4F39pqDfn+kO/tuO6p97+bzSdtrah1uFiAnFOe1uU8PPBUL4PfIHb3+IPYqVFRjBt3RLIUiWecwv8areXhvZpM/h0XTRnZWzbYnnm3XLmAfp1nCqEs7pOhGTybJGd1v18y6XAu6YjHrSX81TJ26WFICMpyxD/QufxKFQlHwVFosQhGYaI4c1pmSJjIASMzduPzMjvFzGunVfAirFoG1kcMhK+h7TdtqCGWqV5s2N8bC+Lo9MYRn7Fruwv2cWL6zPQfWOv4iQ2utGDvB1AAABze3edq305/+gvC+UX5YAAAAAAAAAAAA

[img-12]:data:image/webp;base64,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

[img-13]:data:image/webp;base64,UklGRswIAABXRUJQVlA4IMAIAADwQQCdASotASwBPpFGnUwlo6KiIhI52LASCWdu4XVRAptVSAzSeB8wemr0I/+70//T/tQn7ge7reFP6P6hP64+tz6u3+g9arTevH39R7YP7t+SXXR+x5Rpxn0u/IeYHe7wAvYH+S/Jnz59hsAD8l/q//A8MrUXuuuOu8R9gD84f9T7gPkV/4/L79Uewb/M/7f1qvRVGNFYCZ6zbmat2g345fw90h+MiEXMkD8aWs2I90IGSHpnIy0LvGXrDx2aMyfR0AuEeLrIw80+YubtzX5uDJ9WwQvBj+a/WYZhBO72Ve8A6ym/34O5Qlff28kQ+CxTEomXTzw3C7vnvLDW9XG/tG/qqlSggGk41yBzHLJYxOG3QbTSeY5+Pbs8GBFy8hydFgLYLe3Z29x31GwJYBxcCjewOVqJYn1H6OyLzlhjeR+KgoIZ5UiOIkOphOD2E39NNOS8v+QQreJTpd5ri5GomJsT3uZehihiD4aTY500ITcWFpPBHwsyzCPjuOoq0QVGUuFV0Pfw6YfEGeQI6CBGfR9l0Wiy9Xwo6IZHml8ubx2C0nxsui0WwKcGFHkCgBh+Wqo00wvhKd83wU4b7kFYJ+LkHtE8xh8QcQIz6OuG9VlNML4XCBFAUX0DkMppajBdGR5mHV54hlM+j7LotFl6vhR0QyPNL5c3jsFpPjZdFotgU4MKPIFADD8tVRpphfCU75vgpw32OAD+/1sfB9Nw8kk/77s9BvxLJbgomMd9UgmoB7++HN7Z14C5x8ZGcruDTjuWKWf4na0camk6p7EGz27aQyj4/HJBfXBlipJLkcJaI5oecoz9/oeFSyZb9s+Ih5nzv175n7atL+265uzKbV/Wp6eCok/iDfzynXVHKDBcVKTSkxHrrFZeD+HIb3fHxNHk2rUpb1lLwrNRJ7GWru5K6KYzV+ESkWVoH5DMjXn5/71rcl3ZUkNUaP2ZI4wUnb47+vnzCicABnmoDwEZAoV/RalU8x7yTAgkNkHsp7kED4wk4ciipty5qJq5lFTbJkXujJB28RZ1NaOtrmsR7skId+DUSNDVgEe7m/VFw8OMf45kSp3rc08Zx8sGOilNXBrSQqT/c0RJOB1xd2FGH+zXgWkK7xmcsf9s3NMkmvFA3c3xTTeChcbmKvv2j38RpVbuNx1Tg21eUoBS0yHDy4okyGx2Cyee3/5vYhsfUo6wqoa/0GAzguMdvYkP/E8rxfyoD3p1ulJIUq/3fJxMOUVz5kEG/0gPlxsDp2TS5NSzr1q9QhOXdOxFAM+rj53ADwpRBRJPsAJTLChtiAm1rV/4o9Bw6DE/NzPlAoD7koK3/BnoDWR09nRKhixlR3RNXp5TiiijkYybLJD037jfrrGm9YoRVlL/4OHQJOQ+z/aRXKaxra66rHqU31MTgZwKdhasgLQFQS766x5nOccLzYjGbH6TvB1NT+4gVne3Xi9bro94gffN54Dr56NMTDkKLYT4uN4t5mtdZ3n1hNTvPtFc6EGI6jQkiFjC9lEWrB4RyUBl7gLxruyrDItAiMeQahSYBxMa5lBqxYxj8SxkXTXLj0QHnQbilLe/IAGbCq6ow/4Eql1WAsv6BN8Kg1a1gWVAG1iXXtdJ5d8Xlh2IHSREoFo4+BFizYwBD4l0HP+zmgMjyHjrn3P9f/FraaE1uK7eY9D04OReBC64iefT8+GRzGEhc+E5k242WeVy5h6mrCCLT1rTzyLllALqGjOtc/+JjOaqZJ1WCPInAOxEd+woR625G2gC+ZxVObAinbdoTmSbY+Jz8/mYgDn1SvP/OFdP9Q7fGnILZjUTRoyS3xUJhfbwx7l0WKeikC4GVldf1Nzame3A7Gs0j+NWvbhQElQu37IfQfd8KRskLPdETk3rf2VAtD7kWjYsT+OZfADr5Edbg7zruWZIT9t+/LPF/uehVQTz9unvisCOi4DXiUsSLQSxHmMHlCRlQLJ1JipuywT32FGVOM3KD1OBP0qcw+sf3f7TNpTTST3aPtV/vC3dKDpwKnSkn//a2w+YmL4idtVHWrrQy5OG/eDBs8g3wasBtUzlLP0VVMIuAtl3MRPIWPZUjMccJEULO1cm9nVqvGoBEeUp6LBYqI0VlHG9mpJV83gEbNwQJjASUeor3uBXAhgcaZEu7lQC4s4ME63jLtpioFIiFn4KzEkot9wtfQmPsHxOf3oikRboFrY4sRC1ANEOFy5iNSlG3Eyzz48hwCyCrN/BN71Zxm561UNtHgyYpLNd4+czmvzkS3TFi3Kzk54axdsLhIUO1Hjf2fSCtXk2aYsGJSkFYe/MwOIT3+IodTxtf7rJZysb0MKBvscfKed1tVqjwsvAIkYLDmucfKfi3O+XnbNkaxLAOAd7NQTUKmwpM/smrOnJp9nvOdaw+a2PuTbjJUvAAN2EH211k+dEvkR5CUSTdjsMLFNAAvXp8ff+VhOVJZx/Uyurso+cAIKnYTeCVIlSQfVe3cSb93ZcDt3XjQlebpQ3MhZpIdofiGf21Pepy/NgZ8m6Aw6ZdBUjo4XBs7JrQ2TzW9j70fzDUa1YH5lkKA/ksPFK5IEsBhItBfCvZFHH9A7r3EwMHVVS4uAgKcXBKxAc244RHSn7RPMNyV8A6FIvrNSHW3vF16c7r60POwowwIWBbsoYUv12a++kJp02l/nXXTKc0EPQ0XyZHcjSN+FScR/Z5u6fN+ExvJPhvx4E+Ndk434ndM9PYV3dePvBhOG0pZNiSd+LdTDoTGOdVG69qiUmd4+m+3PFiXHsfmnhQjhs9t6QAVm6/avEjzWKdutoJjPulRbrUocc1PUQ8/SW5ApxqyJtzsMAQKKsBGODVK0LqVAD39ZfNe6tIxtfc7TT+9nAWZzjb3EUSy4BkDVjMpxgglJoZCcdjOHyXq549xnO3sFCjnNIlWJrogjvMOEpvSD47FLCoKf0lByV9JQclfSUHJX0lByV9JQclfSUHJX0lByV9JQclfSUHJX0lBwAAA==

[img-14]:data:image/webp;base64,UklGRuIEAABXRUJQVlA4INYEAADQKgCdASosASwBPpFCnEyloyKiINn5SLASCWVu4XYA+cKuy3eA5dyCOpj6gNsB5gP2A/Ub3Y/7r+2PuQ3gD+ReoB+onpo+w3Xa1dZaDnjrZTjO9Uv97/7n9p8330D7A/6n9XD0Wv2xApTvlBQSU959o+bVx1m1cdZtXHWbVx1m1cdZtXHWbVx1m1cdZtXHWbVx1m1cC4lEHgLNR4+8FydRR0qs1h7eU5rD28dUTnxA2xy9QPcs06aHgN5vgP/qh+aBnZXsvUACJCraod7Dc8+tOO1eyeBmFcqbAKKSdJLfaPm1cdaAMIId59o+bVx1m1cdZtXHWbVx1m1cdZtXHWbVx1m1cdZtXG2Ag5IXJ1FHSqzWHt5TmsPbynNYe3lOXE0nnXiaTzrxNJ514mk868TSjXw8C5P2jGcl1u8+M3ygoJKe8+0fNq46zauOs2rjrNq46zauOs2rjrNq46zat/AA/v8fVbzK6fL+z/aPdbdZfwAAAAAAAAAL6kTa/8o6/iTNoP12/4kzZ9//A1/Do1PbT5bQ4PGK7Ke6roToFauhOgVq6E6BWroToFauiJuGeh+abFmvjaaFR6EbnJrbdcqLPVGq4EJz3AvhPbV81lIk/FbDXH9i7qiFiy/o8+Ef2rUb9nimCux8fIN4eJ8FJwPIDPLnSoy/wDyRJN+Bt+L6ULUBn/LDB+tDdE0UZs1CwtiWu0khxj7KByePeP+GfHhJhk7NW0X3GD4CmjiRrKfHldqn96HK6oeuBZRb5hR27eJcwLVNsWBBKra3jMKzd5iRt+Cqck22vxO3aD13Vthuvpqs0HuthBQGFrFSiTTklON472xMIMVclNPkYIGKtWCNdHlVR5XJhElmaSeev0ymxc3dnsFIiOA4cMWVAY9Gyu6KPLU++8wndVoNZh6ZknPsxs7RPw2JbIPEl3Ju1z+meLzH/k9+50dOIFDhE4dOEL5nCMj2rnOrfrQJcGeh+D2QwFzq4D/4hYHx8HbxTKrCeUd7VP/2w91bZq5ISiFpTN/2tPR8PP1PFd+tmTj8m5S86XJADgCI5pXmuSjqjn1uSeyiRM1HdSehkb1EWyLGJS/tPL99bAeG5xV5i1Bb3wCerZBfW9HER3KQ14VimSLaiuLN960SkBih6krXsoUhDV7txvBzvmENdHESUkbevLvMfXWf6vl/uGkZfcrNr4Tjn/X/hhqAydxmQiLBHgyVUyxhBiAZ9sKYjZr3ZgKXs6pilZGQzULpXAXvRUafj5Phryp7j4Wwy3lKH9sS1tgyipyJg2IgUPx52WzFh53DsOOSJJkXYlETVbMiEvTcKeurHh2L2VGU03OTADUFo/j3/H/HCQ2W1OpGEuGhBWPOCHw32aZWcubIw5FeQPuYds3CqpU5BxF2EWY/V7FAPn6TxhKXHGwkYVYMQzFbkZa6NFVFWpoj2K4pqO6oAATb/iLyOnxHhJlvSrtHFpLOqfxlEbna23DpvOJ6au8zYsW3Ps/80dNDZQpMAKtAtJQAAAAAABvUobk4rtGMm53Ty0HexGG/5AtuT0wJ27du3bt27du3bt27du9VWnFsKg/DyfXq+s/NxQTCOMyGb3hW84TfX5S5LZxkuXLjw86Z0peMcwnqRCb6/KXJaTs2BAAAAAAAAAAAAAAAAA==

[img-15]:data:image/webp;base64,UklGRnQEAABXRUJQVlA4IGgEAADQKQCdASosASwBPpFIokwlpKOiIRlY2LASCWdu4XaxBza/qvKZYzdozbAc8l6AOg9/0HsGfqb7AH6m+m17Hn9zyblLyu//xPCDKCajd5D/RcYGkmxieqT/BeOX6n9gndVQvcKEDCe/jtX1bTDoFDei4i/6NJWVwNHz9MrXnFjR8bI25jsGGbJF6xuyLYHX9Rui1sQWs+2ZYZ8r4GdImTSlx1L4eyResgmnzumd24QiYsL1jjABMSRVeki9ZBNPpaoR+YDNki9Y4wF7bwcduDNki9EQkR4nBlMuDNkiKmmBcrPVAWQUNioqvSMkJEeXBmyMkJEeJwZTLgzZIippgXKz1QFkFDYqKr0jJCRHlwZsjJCRHicGUy4M2SIqaYFys9UBZBQ2Kiq9IyQkR5cGbIyQkR4nBlMuDNkiKmmBcrPVAWQUNioqvSMkJEeXBmyMkJEeJwZTLdgAAP7/k2U34X5+c1imr1AgeisbSKsC7Y3/aovSz6pPScpDhhm+seHtN8Jij/qNeCVfkg+2fiif/+/vQXBlkP+sqTqUuynYX1jBpLD2yP/2fS8gfyOqZq2XzLlyLpitJEVT30scg4zWSEj84akULx63Mszrbs6NtT/hhD0bndz/fHtG7owwqajlqMpqGAmop64PO3jypg50pMkLyp4LBzWGZL7Cru9oRkY7g2JAGSbmng237ikIf8WmwY2Z3+P371P882o4C8j7XV1px6NMJc1yGEb5MrVUpiAhj4DWCHH2eou7D0TF+kv1hbp72Pr36/GZaKfOWLUlwmGp6sdf36Wp9Ngn8nrxhckWPnq5wSYAGDvTkvZR9XNHgVY9Anz5EI/Ztu69sf9AbInysLsZh8tP1BfMN+VkYOD3lacrqloyjW571Y421EsAxfw/CJTIH/mF8OTG5Df7QYyy6G18+sdeJxGN31W3oFx2QF5SKwXLgLeNJo2nyhClvwglZiCupnVCxc8rQv+NdH0JuRtcMQLNli32DFhT/NfaDhCV1bRnus6KR29WSitnv6ZWuPcD3qAfviwFFNES93hkY2MKfzZWzVsuTOypf3usWygyn/3y3/66f/88J9xPuq0DarTol2T3VKo+n5C9bWI9hdWu35lO5LmyVbxqTr+sme6jYpz+mCDu/DrvJTObVwQqNtrzAuuDnNngjidUeuwVmBeP+qBoEecGKIgpy9osvZs4cxVY0h1/Kn33xBzlCyAjbc9DXdzAJ4krSc3oau4WTzZ7SWED99ufiLxazB7QLVcpAUIdfG2SR2vdQMsGyq9A2whJRKI9oX2AjXvCdAi04vz0oap8qOwmMpy1erz0335gaNNleP3gPWPe25XRBaYou17mgFwaS4rTwibd4LcZJ/+IofaPogBHeIweIBoz6qzu4/BYEg+tmdm0CzABvPnR0yRMzy24lnzBuFA2DBejaWUOk2q8H8bVeD+NqvB/G1Xg/jarwfxtV4P42q8H8bVeD+NqvB/G1Xg/jarwfxtV4P42q8EAAAA=

[img-16]:data:image/webp;base64,UklGRl4EAABXRUJQVlA4IFIEAAAQKQCdASosASwBPpFIoUwlpKMiIPTY8LASCWdu4XVREL8vsVN7wANsBzr3oY5472Fv6N/kPYA6Tn+75OOvH+W142+zKCMb2uLMR/rnnrZvnqT2Bf1uCs42ZjkPYncoqGmSG69f5Hy0KA5Xugmw3G9RaTIoSP/94jM8LJVRdpz5sxnyhH0wcQxicF+vOTBn+7AV2twmQpQod/LywLK2dMOMUlkY39r8fOtTy+2yaekwYj861PL7drYu2ZCKp3OmHGfEi0uzIRMGHsjQl1xiQEgIy9M9GarMezIRWBGZ6D2hLrjEgJARl6Z6M1WY9mQisCMz0HtCXXGJASAjL0z0Zqsx7MhFYEZnoPaEuuMSAkBGXpnozVZj2ZCKwIzPQe0JdcYkBICMvTPRmqzHsyEVgRmeg9oS64xICQEZemejNVmPZkIrAjM9B7Ql1xiQEgIy9MAAAP7/MqjU0AMC/KEosr6+zVpr2FGHaUgCdDbl//b/KOagIJMQTVz/nVHvCFcJlSdZf7mskbhjMvg1TROuCc97Syczr4GtknLxmW9AztlSj/41Q244EvM1z9L/UlGCBZSMTA61Rc5Hwjnz5C+QtKCwJYwCA+MeYWZE9PkZrannobejWAt3knZ7lc1rZZMXlNPgmlgj+P3Mia0Rbr249K+QQLjjHflmcZUs86HH4WGIugFsdiex+FL8nYGMqYnqBe1OA2nBViHGfignKtGhLhZSaMb3/56zVo+Op44Z2uyIgKaUyApzxZU0yP2aSMiVZfTX/c0t+Izncb9P5cNyePgiB22EmpWaaA5gMtylvZ7dFkxxPazrIAZuT9mHPF1TJUIBi+GfSU39hCuVrJhi4947wtXNnNP/r8ui3BEMUk0n3VCxzdof8QHH/nc6YYDA9e2Tq0llxVI3S9Wz+lVtDi7/9rW4R7UuHJ+9nvUv4k0fs2YILz5sOEg45zpNsCJREvxxtfZ8Va6AkoGbKL5c6g+QfHo6SgVBnPNjldnG36WK2wDC6uR+MsBM8ngQLM3Q2F9nYTfxd5SAAEP8b5L9FNpkzT1MlntOUa01C5DtskD/6QYTTyqEz0yDuCGvt9Ygf/4YGFUvdVTZzQXfy1x5d13P+aIrsV//NEV1Jbx1FNlh01nY10AYkMvPhfm31z9xecr5B/bCp9liFFjmNphgSCQ1tO9mSb3sPGMhBqNYjSx+g/nMlQDnH7Ru/iEvoS/ra/Cr2nrfgsuk4SiEwSutzz2T5XgLAGJspOWSThteHTLv6356wxL83Y+H/Y7yQwhTm5ztFJOTuBwHKyFHsEUfM9E8AHAplaKvq6v6YmBFf5chvuR5EiDg+xCwz4twUozSlgg8p/93buhdR833dUrblrUgv/G+GBRFELArBbtWr5q7eI3mkgdq+Ecj73DCUZOZNnpzrHHXxJbwIAIhsDmKp6VovAcSIOJEHEiDiRBxIg4kQcSIOJEHEiDiRBxIg4kQcAAAAA==