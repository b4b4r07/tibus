FROM mysql:5.5
MAINTAINER Kyoichi Ozaki <kyoichi@gmail.com>

COPY ./localdb-run.sh /
RUN chmod 755 /localdb-run.sh

ENTRYPOINT ["/localdb-run.sh"]