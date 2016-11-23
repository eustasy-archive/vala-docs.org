VALA_VERSION := $(shell vala --version | awk -F. '{ print "0."$$2 }')

DEPS := valadoc-1.0 libxml-2.0
VALAFLAGS := $(patsubst %,--pkg=%,$(DEPS)) -g

CFLAGS := -g -shared -fPIC $(shell pkg-config --cflags $(DEPS))
LDLIBS := $(shell pkg-config --libs $(DEPS))

generate-xml: update-girs generator libdoclet.so
	$(RM) -r docs
	G_MESSAGES_DEBUG=all valadoc \
		-o docs \
		--importdir girs/gir-1.0 \
		--import GLib-2.0 \
		--import GObject-2.0 \
		--girdir girs/gir-1.0 \
		--vapidir girs/vala/vapi \
		--doclet . \
		--driver $(VALA_VERSION) \
		--deps

generator: generator.vala
	valac $(VALAFLAGS) -o $@ $^

libdoclet.so: doclet.vala
	valac $(VALAFLAGS) -C $^
	$(CC) $(CFLAGS) $(LDLIBS) -o $@ $(patsubst %.vala,%.c,$^)
	$(RM) $(patsubst %.vala,%.c,$^)

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
