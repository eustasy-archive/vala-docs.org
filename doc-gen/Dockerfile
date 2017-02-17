# doc-gen/Dockerfile
# Creates a docker container to build doc files with
# Build with `docker build -t valadoc .`
# Run with `docker run -v $(pwd):/valadoc valadoc`

FROM ubuntu:16.04

RUN apt update && apt install -y \
    python-software-properties \
    software-properties-common

RUN add-apt-repository ppa:vala-team/ppa

RUN apt update && apt install -y \
    git \
    libvaladoc-dev \
    libxml2-dev \
    valac \
    valadoc

CMD cd /valadoc && make
