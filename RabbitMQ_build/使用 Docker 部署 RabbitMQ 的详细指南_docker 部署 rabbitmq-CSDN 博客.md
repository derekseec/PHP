> 本文由 [简悦 SimpRead](http://ksria.com/simpread/) 转码， 原文地址 [blog.csdn.net](https://blog.csdn.net/Li_WenZhang/article/details/141181632)

#### 使用 Docker 部署 [RabbitMQ](https://so.csdn.net/so/search?q=RabbitMQ&spm=1001.2101.3001.7020) 的详细指南

在现代[应用程序开发](https://so.csdn.net/so/search?q=%E5%BA%94%E7%94%A8%E7%A8%8B%E5%BA%8F%E5%BC%80%E5%8F%91&spm=1001.2101.3001.7020)中，消息[队列](https://edu.csdn.net/course/detail/40020?utm_source=glcblog&spm=1001.2101.3001.7020)系统是不可或缺的一部分。RabbitMQ 是一个流行的开源消息代理软件，它实现了高级消息队列协议（AMQP）。本文将详细介绍如何使用 Docker 部署 RabbitMQ，并提供一些配置和管理的技巧。

##### 1. 前期准备

在开始之前，请确保您的系统上已经安装了 Docker。如果尚未安装，可以参考 [Docker 官方文档](https://docs.docker.com/get-docker/) 或我写的前面一篇文章 [CentOS 上安装 Docker 的详细指南](https://blog.csdn.net/Li_WenZhang/article/details/141051155) 进行安装。

##### 2. 停止并移除现有的 RabbitMQ 容器

如果您的系统上已经运行了 RabbitMQ 容器，可以使用以下命令停止并移除它：

```
docker stop rabbitmq
docker rm rabbitmq

```

![](https://i-blog.csdnimg.cn/direct/496131c83f544e85a7f59709fd842477.png)

##### 3. 启动 RabbitMQ 容器

使用以下命令启动一个新的 RabbitMQ 容器：

```
# 拉取docker镜像
docker pull rabbitmq:management
mkdir -p /usr/local/docker/rabbitmq

docker run -id --name=rabbitmq -v /usr/local/docker/rabbitmq:/var/lib/rabbitmq -p 15672:15672 -p 5672:5672 -e RABBITMQ_DEFAULT_USER=admin -e RABBITMQ_DEFAULT_PASS=admin rabbitmq:management

```

![](https://i-blog.csdnimg.cn/direct/04309081b50641f9945303944357e686.png)

在这条命令中，我们做了以下配置：

*   `-id`：以交互模式启动容器并在后台运行。
*   `--name=rabbitmq`：为容器指定一个名称。
*   `-v /usr/local/docker/rabbitmq:/var/lib/rabbitmq`：将主机目录挂载到容器内的 `/var/lib/rabbitmq`，用于持久化数据。
*   `-p 15672:15672`：映射 RabbitMQ 管理页面端口。
*   `-p 5672:5672`：映射 RabbitMQ 消息接收端口。
*   `-e RABBITMQ_DEFAULT_USER=admin`：设置默认用户名。
*   `-e RABBITMQ_DEFAULT_PASS=admin`：设置默认密码。

##### 4. 查看容器日志

启动容器后，可以使用以下命令查看容器日志，确保 RabbitMQ 正常启动：

```
docker logs -f rabbitmq

```

![](https://i-blog.csdnimg.cn/direct/e23c1f15f1f84cd8a9a8d8d1e5f2d918.png)

##### 5. 访问 RabbitMQ 管理界面

在浏览器中访问 `http://<你的服务器地址>:15672`，使用之前设置的用户名和密码（`admin` 和 `admin`）登录，即可访问 RabbitMQ 的管理界面。

##### 6. 配置说明

*   **15672 端口**：RabbitMQ 的管理页面端口。
*   **5672 端口**：RabbitMQ 的消息接收端口。
*   **RABBITMQ_DEFAULT_USER 环境变量**：指定 RabbitMQ 的用户名。
*   **RABBITMQ_DEFAULT_PASS 环境变量**：指定 RabbitMQ 的密码。

##### 7. 环境变量配置

RabbitMQ 容器通过指定环境变量的方式进行配置，这比修改配置文件便捷得多。以下是一些常用的环境变量：

*   `RABBITMQ_DEFAULT_USER`：默认用户名。
*   `RABBITMQ_DEFAULT_PASS`：默认密码。
*   `RABBITMQ_ERLANG_COOKIE`：Erlang 集群 cookie。
*   `RABBITMQ_NODENAME`：节点名称。

更多环境变量的详细信息可以参考 [RabbitMQ 官方文档](https://www.rabbitmq.com/configure.html)。

##### 8. 持久化数据

为了确保 RabbitMQ 的数据在容器重启或删除后不会丢失，我们使用了 Docker 的卷（volume）功能。通过 `-v /usr/local/docker/rabbitmq:/var/lib/rabbitmq` 参数，我们将主机目录挂载到容器内的 `/var/lib/rabbitmq`，实现数据持久化。

##### 9. 备份与恢复

为了防止数据丢失，定期备份 RabbitMQ 的数据是非常重要的。可以使用以下命令备份数据：

```
docker exec rabbitmq tar czf /backup/rabbitmq_backup.tar.gz /var/lib/rabbitmq

```

要恢复数据，可以使用以下命令：

```
docker exec rabbitmq tar xzf /backup/rabbitmq_backup.tar.gz -C /

```

##### 10. 集群配置

RabbitMQ 支持集群配置，可以通过以下步骤实现：

1.  启动多个 RabbitMQ 容器，并确保它们可以相互通信。
2.  在每个节点上设置相同的 `RABBITMQ_ERLANG_COOKIE`。
3.  使用 `rabbitmqctl` 命令将节点加入集群：

```
docker exec rabbitmq1 rabbitmqctl stop_app
docker exec rabbitmq1 rabbitmqctl join_cluster rabbit@rabbitmq2
docker exec rabbitmq1 rabbitmqctl start_app

```

##### 11. [性能优化](https://edu.csdn.net/cloud/sd_summit?utm_source=glcblog&spm=1001.2101.3001.7020)

为了提高 RabbitMQ 的性能，可以考虑以下优化措施：

*   调整 `vm_memory_high_watermark` 参数，控制内存使用。
*   使用 `rabbitmq_management` 插件监控性能。
*   调整 `disk_free_limit` 参数，确保磁盘空间充足。

##### 12. 常见问题排查

在使用 RabbitMQ 时，可能会遇到一些常见问题。以下是一些排查方法：

*   **无法访问管理界面**：检查 15672 端口是否开放，确保防火墙未阻止该端口。
*   **消息堆积**：检查消费者是否正常工作，确保消息被及时处理。
*   **内存不足**：调整 `vm_memory_high_watermark` 参数，增加内存限制。