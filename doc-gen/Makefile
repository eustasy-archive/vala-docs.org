VALA_VERSION := $(shell vala --version | awk -F. '{ print "0."$$2 }')

DEPS := valadoc-1.0 libxml-2.0
VALA_DEPS := $(foreach dep,$(DEPS),--pkg $(dep))

CFLAGS := -g -shared -fPIC $(shell pkg-config --cflags $(DEPS))
LDLIBS := $(shell pkg-config --libs $(DEPS))

generate-xml: update-girs libdoclet.so
	$(RM) -r docs
	G_MESSAGES_DEBUG=all valadoc \
		-o docs \
		--importdir girs/gir-1.0 \
		--import GLib-2.0 \
		--girdir girs/gir-1.0 \
		--vapidir girs/vala/vapi \
		--doclet . \
		--driver $(VALA_VERSION) \
		--deps

doclet.c: doclet.vala
	valac -g -C $(VALA_DEPS) $<

libdoclet.so: doclet.c
	$(CC) $(CFLAGS) $(LDLIBS) -o $@ $<

update-girs:
	[ -d girs ] && git -C girs pull || git clone https://github.com/nemequ/vala-girs.git girs

generate-all: update-girs libdoclet.so
	$(RM) -r docs
	for pkg in $(shell find /usr/share/vala-$(VALA_VERSION)/vapi -name '*.vapi' | cut -d '/' -f 6 | sed 's/\.vapi//'); do \
		echo $$pkg; \
		G_MESSAGES_DEBUG=all valadoc \
			-o docs/$$pkg \
			--pkg $$pkg \
			--girdir girs/gir-1.0/ \
			--vapidir girs/vala/vapi/ \
			--doclet . \
			--driver $(VALA_VERSION) \
			--deps; \
	done

.PHONY: generate-xml generate-all update-girs
